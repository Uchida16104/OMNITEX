from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI(
    title="OMNITEX Python FastAPI Service",
    version="1.0.0",
)

app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "https://omnitex.vercel.app",
        "https://omnitex-ph5mbqfhh-uchida16104s-projects.vercel.app",
        "http://localhost:5173",
        "http://127.0.0.1:5173",
    ],
    allow_credentials=False,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/network/analyze")
async def analyze():
    return {
        "status": "analysis complete",
        "message": "Network analysis finished successfully.",
        "service": "omnitex-python-fastapi-service",
        "endpoint": "/network/analyze",
    }

@app.get("/health")
async def health():
    return {"status": "ok"}
