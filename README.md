# 💪 BeFit: Gym Membership Management System

Welcome to **BeFit**, a responsive web-based gym membership management system. This project allows users to register, log in, view/update their membership plan, and securely log out. Built using **PHP, MySQL, HTML/CSS, JavaScript**, and deployed on **InfinityFree hosting**.

---

## 🚀 Features

- 🔐 Secure User Registration with Password Hashing
- 🔑 Login Authentication with Session Handling
- 🏠 Dashboard to View & Update Selected Gym Plan
- 📝 Plan Options: Basic, Premium, Pro
- 🚪 Logout with Session Destruction
- 🎨 Fully Responsive Landing Page (index.html)
- 📦 Deployed on [InfinityFree](https://infinityfree.net)

---

## 📁 Project Structure

/htdocs/
- │
- ├── index.html # Landing Page
- ├── login.php # Login Form
- ├── register.php # User Registration
- ├── home.php # Dashboard (Plan Update + Logout)
- ├── logout.php # Session Logout
- ├── dbconn.php # Database Connection
- │
- ├── style.css # Styling for all components
- ├── style_home.css # (optional, if separated)
- ├── script.js # JavaScript for UI actions
- ├── befit.sql # Database Structure (users table)
- └── /images/ # Used by index.html


---

## ⚙️ Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap 4, FontAwesome
- **Backend**: PHP (Procedural)
- **Database**: MySQL
- **Hosting**: InfinityFree + PHPMyAdmin
- **Security**: Password Hashing, Prepared Statements

---

## ✅ How to Use

1. 🛠 Clone or download the project
2. 🧩 Import `befit.sql` into your MySQL database
3. 🔧 Update database credentials in `dbconn.php`
4. 🧪 Run locally or upload to InfinityFree or any PHP-enabled host
5. 🔑 Visit `register.php` → register a user → test login → update plan → logout

---

## 📝 TODO List

```markdown
# 📌 TODO: Planned Improvements

- [ ] Add email & phone number fields to registration
- [ ] Email verification and forgot password flow
- [ ] Admin dashboard to:
  - [ ] View all users and plans
  - [ ] Add/edit/delete membership plans
  - [ ] Manage trainers/blogs dynamically
- [ ] Plan expiration and renewal system
- [ ] Monthly billing and payment integration (e.g. Razorpay/Stripe)


## Aniket Behera

Deployed & tested on: InfinityFree Hosting
Frontend + Backend Development, UI/UX, Deployment

🖼️ Live Demo (if you want to share)
befit.infinityfreeapp.com



