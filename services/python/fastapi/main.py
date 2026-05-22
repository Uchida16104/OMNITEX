from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel

app = FastAPI(title="Unified Polyglot Dashboard API")

app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "http://localhost:5173",
        "http://127.0.0.1:5173",
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
