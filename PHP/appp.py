from fastapi import FastAPI
from pydantic import BaseModel
from google import genai
from google.genai import types
import mysql.connector
import json
import re
import nest_asyncio
import uvicorn

app = FastAPI()

# إعداد عميل الذكاء الاصطناعي
client = genai.Client(api_key="AIzaSyBAg5hWfCyMXWdodkbSkT-L_0Xpco-aCZM")

# نموذج الطلب
class MessageRequest(BaseModel):
    message: str

# إعداد الاتصال بقاعدة البيانات
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="roqsa_frha_2026"
)
cursor = db.cursor(dictionary=True)

# جلب الخدمات من قاعدة البيانات
def get_services():
    cursor.execute("SELECT id,name,address, price, description, image,rating_Admin FROM shop")
    return cursor.fetchall()

@app.post("/ai-event/")
async def analyze_event(request: MessageRequest):
    services = get_services()
    content_text = ""
    for s in services:
        content_text += f"-{s['id']}:{s['name']}: {s['address']}: {s['price']} ريال. وصف: {s['description']}: {s['image']}:{s['rating_Admin']}\n"

    # برومت الذكاء الاصطناعي مع إجبار إخراج JSON
    analysis_prompt = f"""\
أنت مساعد ذكي لتطبيق فرحة المتخصص في خدمات المناسبات والأفراح.
التزم بالتالي:
- الإجابة  فيما تراه يتعلق بالافراح والمناسبات مثل الزينة الوان ويمكنك التجاوب مع العملاء .
-  من ناحية الخدمات يمنع منعًا باتًا اختراع خدمات أو أسعار غير موجودة في البيانات.
- الرد يجب أن يكون دائمًا بصيغة JSON كما في المثال التالي:
{{
  "message": "رسالة نصية أو وصف الاقتراح",
  "services": [
    {{"id": " id ", "category": "قاعات ","name": "اسم القاعة","address": "وصف موقع القاعة", "price": 0,"image": "اسم الصورة","rating_Admin": "تقييم القاعة"}},
    {{"id": "id  ", "category": "الفنان ", "name": "اسم الفنان", "address": "وصف موقع الفنان","price": 0,"image": "اسم الصورة","rating_Admin": "تقييم الفنان"}}
  ],
  "total_cost": 0,
  "remaining_budget": 0
}}
- إذا لم توجد بيانات كافية في النظام، اجعل :

  "message": "رد باسلوب منمق انك مساعد ذكي يختص بالافراح والمناسبات",


- عند طلب المستخدم تنظيم مناسبة (عرس – خطوبة – عيد ميلاد – تخرج):
- قم بتحليل نوع المناسبة.
- اعتمد فقط على الخدمات الموجودة في البيانات (قاعة، فنان، تصميم،كوش، ديكور، حلويات،شاليهات ، المصورين).
- اختر خدمات بحيث يكون مجموعها قريب من الميزانية دون تجاوزها.
- إذا لم يمكن الالتزام بالميزانية، اقترح أفضل توزيع ممكن واذكر الفرق.

- عملة التطبيق الريال اليمني، إذا طلب العميل بالدولار أو الريال السعودي احسب حسب الصرف: 1$ = 535 ريال، 1 ريال سعودي = 140 ريال.
-عند اعطاءك المستخدم الميزانية  ونوع الحفلة عرس قم تقسيم الميزانية على الخدمات التالية
القاعات 30%واحد فقط 
الفنان 45% واحد فقط
الوجبات والقرطاسية 5% واحد فقط
التصوير 15% واحد فقط
كوشة 5% واحد فقط
-وعند عدم اعطاءك المستخدم الميزانية ونوع الحفلة عرس قم باقتراح خدمات حسب التقسيم التالي سواء فاخرة اومتوسطة او اقتصادية
 قاعة فقط القاعات
 فنان واحد الفنان
واحد فقط الوجبات والقرطاسية
  واحد فقط التصوير
 واحد فقط كوشة
البيانات المتاحة:
{content_text}

رسالة العميل:
{request.message}
"""

    try:
        # استدعاء نموذج Gemini
        response = client.models.generate_content(
            model="gemini-2.5-flash",
            contents=analysis_prompt
        )

        text = response.text.strip()

        # --- استخراج JSON من النص ---
        try:
            match = re.search(r"\{.*\}", text, re.DOTALL)
            if match:
                ai_response = json.loads(match.group())
            else:
                ai_response = {
                    "message": text,
                    "services": [],
                    "total_cost": 0,
                    "remaining_budget": 0
                }
        except json.JSONDecodeError:
            ai_response = {
                "message": text,
                "services": [],
                "total_cost": 0,
                "remaining_budget": 0
            }

        return ai_response

    except Exception as e:
        return {"error": str(e)}

@app.get("/")
def root():
    return {"message": "API is working"}