# VALORA Recruitment Portal

Website tuyển dụng demo cho **VALORA TRADING & SERVICES**, xây dựng bằng Laravel 12, PHP 8.2, MySQL, Blade và Bootstrap 5.

## Chạy project

```bash
composer install
npm install
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Tài khoản HR demo:

- Email: `admin@valora.demo`
- Mật khẩu: `Valora@123`

CV được lưu ở private disk (`storage/app/private/applications/cvs`) và chỉ truy cập qua route admin đã xác thực.

Ảnh hero demo: [Unsplash photo 1521737711867](https://unsplash.com/photos/QckxruozjRg), tải cục bộ vào `public/images/valora-team.jpg`.
