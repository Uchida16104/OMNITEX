from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel

app = FastAPI(title="Unified Polyglot Dashboard API")

app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "http://omnitex.vercel.app:5173",
        "https://omnitex.vercel.app:5173",
    ],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


class NetworkAnalysisResponse(BaseModel):
    status: str
    message: str


@app.get("/api/network/analyze", response_model=NetworkAnalysisResponse)
async def analyze():
    return {
        "status": "ok",
        "message": "analysis complete",
    }
