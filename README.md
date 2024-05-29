# Event Management System

## Kurulum

1. Depoyu klonlayın:
    ```bash
    git clone https://github.com/enesekinci/event-management-system.git
    cd event-management-system
    ```

2. env dosyasını oluşturun:
    ```bash
    cp .env.example .env

3. Gerekli bağımlılıkları yükleyin:
    ```bash
    composer install
    ```

4. Sail ile çalıştırmak için:
    ```bash
    ./vendor/bin/sail up
    ```

5. Uygulama anahtarını ve passport anahtarlarını oluşturun:
    ```bash
    ./vendor/bin/sail artisan key:generate
   ./vendor/bin/sail artisan passport:keys
    ```

6. Veritabanını ayarlarını yapın ve migrationları çalıştırın:
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

7. Tüm kurulum adımlarını tek bir komutla yapmak için:
    ```bash
    ./install
    ```

## API Endpoints

- **Etkinlikler:
  **`GET /api/events`, `POST /api/events`, `GET /api/events/{id}`, `PUT /api/events/{id}`, `DELETE /api/events/{id}`
- **Etkinlik Kaydı:** `POST /api/events/{id}/register`
- **Kayıt İptali:** `DELETE /api/events/{id}/register`

## Testler

PHPUnit testlerini çalıştırmak için:

```bash
./vendor/bin/sail artisan key:generate --env=testing
./vendor/bin/sail artisan test  --env=testing
```
