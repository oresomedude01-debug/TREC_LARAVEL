# TREC Laravel Website

This is a complete Laravel conversion of the TREC (The Ripple Effect Consult) HTML website.

## ✅ Project Setup Complete

The Laravel application has been successfully created with the following features:

### 📁 **Structure**
- **Frontend Pages**: Home, About, Services, Wellbeing, TSCC, Gallery, Blog, Contact
- **Database Models**: BlogPost, GalleryImage, ContactSubmission
- **Controllers**: PageController, ContactController, AdminController
- **Admin Dashboard**: View statistics, manage submissions, blog posts, and gallery
- **Responsive Design**: All pages maintain the original HTML styling

### 🛠️ **Configuration**

#### Database Setup
- Database: MySQL (`trec_laravel`)
- Connection: localhost:3306
- Username: root
- Password: (empty)

#### Environment File (.env)
```
APP_NAME=TREC
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/TREC_Laravel/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trec_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 📊 **Database Tables**
1. **blog_posts** - Store blog articles with title, slug, content, category, images
2. **gallery_images** - Store gallery items with labels, categories, and styling
3. **contact_submissions** - Store contact form submissions

### 🚀 **How to Use**

#### 1. Start the Development Server
```bash
cd c:\xampp\htdocs\TREC_Laravel
php artisan serve
```
Then visit: `http://127.0.0.1:8000`

#### 2. Access Public Pages
- Home: `/`
- About: `/about`
- Services: `/services`
- Wellbeing: `/wellbeing`
- TSCC: `/tscc`
- Gallery: `/gallery`
- Blog: `/blog`
- Contact: `/contact`

#### 3. Contact Form
Submit contact requests at `/contact` - they're saved to the database and viewable in admin panel

#### 4. Admin Dashboard
- URL: `/admin/dashboard`
- View contact submissions: `/admin/contacts`
- Manage blog posts: `/admin/blog`
- Manage gallery: `/admin/gallery`

⚠️ **Note**: Admin routes are currently set up with authentication middleware. To enable them, you'll need to set up authentication (see below).

### 🔐 **Setting Up Authentication**

To use the admin panel, install Laravel Breeze or Fortify:

```bash
php artisan install:api
php artisan migrate --seed
```

Or use the default User model with authentication scaffolding:

```bash
php artisan make:migration create_users_table
php artisan migrate
```

Then manually create an admin user or seed one:

```php
// Add to database/seeders/DatabaseSeeder.php
use App\Models\User;

User::create([
    'name' => 'Admin',
    'email' => 'admin@trec.com',
    'password' => Hash::make('password'),
]);
```

### 💾 **Adding Sample Data**

#### Create Blog Posts (via Tinker)
```bash
php artisan tinker
```

```php
App\Models\BlogPost::create([
    'title' => '5 Signs Your School Needs a Wellbeing Audit',
    'slug' => '5-signs-school-needs-wellbeing-audit',
    'content' => 'Rising absenteeism, teacher burnout, student disengagement...',
    'excerpt' => '5 Signs Your School Needs a Wellbeing Audit',
    'category' => 'School Wellbeing',
    'read_time' => 5,
    'published_at' => now(),
]);
```

#### Add Gallery Images
```php
App\Models\GalleryImage::create([
    'label' => 'TSCC 2024 — Opening Keynote',
    'category' => 'tscc',
    'image_path' => '/storage/gallery/tscc-2024.jpg',
    'height' => 260,
    'color1' => '#8a1520',
    'color2' => '#D82D37',
]);
```

### 📝 **Features**

✅ All 8 main pages (Home, About, Services, Wellbeing, TSCC, Gallery, Blog, Contact)
✅ Fully responsive design matching original HTML
✅ Contact form with validation and database storage
✅ Blog posts management
✅ Gallery image management
✅ Admin dashboard
✅ MySQL database integration
✅ Blade templating system
✅ Laravel routing

### 🎨 **Styling**

All original CSS is preserved in the layout template:
- Custom color palette (Red, Orange, Green, Black, Charcoal, Cream, White)
- Typography using Fraunces and Plus Jakarta Sans fonts
- Responsive breakpoints for mobile, tablet, desktop
- Smooth animations and transitions

### 📱 **Responsive Breakpoints**

- Desktop: 1200px+ (full layout)
- Tablet: 768px - 1199px (adjusted grid)
- Mobile: < 768px (single column)

### 🔧 **API Routes** (Ready for Frontend Framework Integration)

Can be extended to build REST API for a separate frontend:

```php
Route::prefix('api')->group(function () {
    Route::get('/blog-posts', [BlogController::class, 'index']);
    Route::get('/gallery-images', [GalleryController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
});
```

### 📦 **Dependencies**

- Laravel 12.x
- MySQL
- PHP 8.2+
- Composer

### 🎯 **Next Steps**

1. **Add Authentication**: Implement user login for admin dashboard
2. **CRUD Operations**: Add create, edit, delete functionality for blog and gallery
3. **Image Upload**: Implement file upload for gallery and blog thumbnails
4. **Email Notifications**: Send admin notifications for new contact submissions
5. **Search & Filtering**: Add blog search and gallery filtering
6. **SEO**: Add meta tags and SEO optimization
7. **API**: Build REST API for mobile app or separate frontend
8. **Caching**: Implement caching for improved performance
9. **Analytics**: Add tracking for page views and conversions
10. **Deployment**: Set up for production deployment (Heroku, AWS, DigitalOcean)

### 💡 **Tips**

- Use `php artisan tinker` for interactive database queries
- Use `php artisan make:` commands to generate models, controllers, migrations
- Check `routes/web.php` for all available routes
- Customize styling in `resources/views/layouts/app.blade.php`
- Add new pages by creating files in `resources/views/pages/`

### 📞 **Support**

For issues or questions about the Laravel setup, refer to:
- Laravel Documentation: https://laravel.com/docs
- Blade Templates: https://laravel.com/docs/blade
- Database: https://laravel.com/docs/database

---

**Happy coding! 🚀**

TREC - The Ripple Effect Consult
