from fastapi import FastAPI

app = FastAPI()

@app.get("/network/analyze")
async def analyze():
    return {"status": "analysis complete"}
