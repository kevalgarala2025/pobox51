# POBox51 - Laravel Application

POBox51 is a Laravel-based application that provides contact exchange and communication services with social media integration.

## System Requirements

- **PHP**: 8.2.2 or higher
- **Composer**: Latest version
- **Node.js**: 18.x or higher (for asset compilation)
- **MySQL**: 5.7 or higher
- **Apache/Nginx**: Web server
- **Extensions**: mbstring, xml, curl, bcmath, intl, zip, soap, xsl, gd, imap, mailparse

## Installation Guide

### Method 1: Local Development Setup

#### 1. Clone the Repository
```bash
git clone https://bitbucket.org/pivotdrive/pobox51.git
cd pobox51
```

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Install Node.js Dependencies
```bash
npm install
```

#### 4. Environment Configuration
Create your environment file:
```bash
cp docker/docker.env .env
```

Edit the `.env` file with your configuration:
```env
APP_NAME="POBox51"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_PREFIX=tbl_

# Mail Configuration (Optional for development)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Social Media Integration (Optional)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_SECRET_KEY=your_google_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/user/auth/google/callback

FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_SECRET_KEY=your_facebook_secret
FACEBOOK_REDIRECT_URL=http://localhost:8000/user/auth/facebook/callback

# Add other social media configurations as needed
```

#### 5. Generate Application Key
```bash
php artisan key:generate
```

#### 6. Database Setup
Create your database and run migrations:
```bash
php artisan migrate
```

#### 7. Compile Assets
For development:
```bash
npm run dev
```

For production:
```bash
npm run production
```

#### 8. Start the Development Server
```bash
php artisan serve
```

Your application will be available at `http://localhost:8000`

### Method 2: Docker Setup

#### 1. Clone the Repository
```bash
git clone https://bitbucket.org/pivotdrive/pobox51.git
cd pobox51
```

#### 2. Build and Run Docker Container
```bash
# Build the Docker image
docker build -t pobox51 .

# Run the container
docker run -d -p 80:80 -p 443:443 --name pobox51-app pobox51
```

#### 3. Access the Application
- HTTP: `http://localhost`
- HTTPS: `https://localhost` (if SSL is configured)

## Development Commands

### Asset Compilation
```bash
# Watch for changes during development
npm run watch

# Hot reload for development
npm run hot

# Build for production
npm run production
```

### Laravel Commands
```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Run database migrations
php artisan migrate

# Run database seeders
php artisan db:seed
```

## Project Structure

```
pobox51/
├── app/                    # Application logic
│   ├── Console/           # Artisan commands
│   ├── Http/              # Controllers, middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic services
├── config/                # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Web accessible files
├── resources/             # Views, assets, language files
│   ├── css/              # CSS files
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── routes/                # Route definitions
├── storage/               # File storage, logs, cache
└── tests/                 # Test files
```

## Features

- **User Management**: Registration, authentication, profile management
- **Social Media Integration**: Google, Facebook, LinkedIn, Twitter, Instagram, GitHub, Apple
- **Email Services**: SMTP configuration with IMAP support
- **Contact Exchange**: Business card and contact sharing
- **File Management**: Upload and storage capabilities
- **Responsive Design**: Mobile-friendly interface
- **Admin Panel**: Administrative interface for content management

## Configuration

### Database
The application uses MySQL with a table prefix `tbl_`. Ensure your database configuration in `.env` matches your MySQL setup.

### Mail Configuration
Configure SMTP settings for email functionality. The application supports both standard SMTP and AWS SES.

### Social Media Integration
Configure OAuth credentials for social media login integration. Each platform requires specific client ID and secret key setup.

## Troubleshooting

### Common Issues

1. **Permission Errors**: Ensure storage and bootstrap/cache directories are writable
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

2. **Composer Memory Issues**: Increase memory limit
   ```bash
   php -d memory_limit=2G /usr/local/bin/composer install
   ```

3. **Asset Compilation Issues**: Clear npm cache and reinstall
   ```bash
   npm cache clean --force
   rm -rf node_modules package-lock.json
   npm install
   ```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is proprietary software. All rights reserved.

## Support

For support and questions, please contact the development team.
