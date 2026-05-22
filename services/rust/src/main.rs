use actix_web::{get, App, HttpServer, Responder};

#[get("/network/status")]
async fn status() -> impl Responder {
    "Rust network service online"
}

#[actix_web::main]
async fn main() -> std::io::Result<()> {
    HttpServer::new(|| App::new().service(status))
        .bind(("0.0.0.0", 8080))?
        .run()
        .await
}
