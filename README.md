
# 🌐 TechLink Platform

TechLink is a web-based internship and job placement system for university students. It connects students with companies offering opportunities, facilitates applications, assessments, and enables real-time feedback and notifications. Built with **CodeIgniter 4**, **MySQL**, and enhanced with AI-driven aptitude tests.

---

## 🚀 Features

### 🎓 For Students
- Register, login, and manage profile (skills, portfolio, GitHub, CV, etc.)
- View and apply to opportunities from verified companies
- Track application statuses and test performance
- Take AI-generated aptitude or technical tests
- Receive real-time notifications

### 🏢 For Companies *(to be implemented)*
- Create opportunities
- View applicants and assign tests
- Review test results and shortlist candidates

---

## 🛠️ Tech Stack

| Layer              | Technology               |
|-------------------|--------------------------|
| Backend Framework | CodeIgniter 4 (PHP 8+)   |
| Database          | MySQL                    |
| Frontend          | Bootstrap 5              |
| AI Integration    | OpenAI (optional helper) |
| Testing           | PHPUnit 10               |
| Deployment        | Azure (DevOps Pipelines) |

---

## 📦 Project Structure

```
techlink/
│
├── app/                  → Main application logic (Controllers, Models, Views)
├── public/               → Web root
├── tests/                → PHPUnit test cases
├── writable/             → Uploads & cache
├── .env                  → Environment config (DB, keys)
├── phpunit.xml.dist      → PHPUnit configuration
├── composer.json         → Dependencies
```

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://dev.azure.com/your-org/techlink.git
cd techlink
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

```bash
cp env .env
php spark key:generate
```

Update `.env` with your **DB credentials**, **OpenAI key** (if applicable), and **baseURL**.

### 4. Create the Database

Import the provided SQL file:

```bash
mysql -u root -p techlink < techlink.sql
```

Or use:

```bash
php spark migrate
```

### 5. Run Locally

```bash
php spark serve
```

Access via: [http://localhost:8080](http://localhost:8080)

---

## ✅ Running Tests

```bash
vendor/bin/phpunit
```

All tests are located in `/tests/Unit/`.

---

## 🧠 AI Test Generator (Optional)

Enable OpenAI integration in `app/Helpers/OpenAiHelper.php`. Make sure your `.env` includes:

```env
OPENAI_API_KEY=your-key-here
```

---

## 🧪 Sample Test Flow

1. Student clicks "Take Test"
2. AI generates questions
3. Student submits answers
4. Score calculated + stored
5. Result shown (Pass/Fail)

---

## 📌 Deployment (Azure DevOps)

- Repo is hosted in Azure DevOps
- Pipeline uses a `yaml` file to build & deploy
- Add missing PHP tasks (`UsePHPVersion`) via [Azure Marketplace](https://marketplace.visualstudio.com/)

---

## 🙋‍♂️ Contributors

- **Faith Chepngetich** – Developer / Maintainer

---

## 📄 License

This project is licensed under MIT. See [LICENSE](LICENSE) for details.

---

## 🔗 Links

- [CodeIgniter Docs](https://codeigniter.com/user_guide/)
- [Bootstrap](https://getbootstrap.com)
- [PHPUnit](https://phpunit.de/)
- [OpenAI](https://platform.openai.com/)
