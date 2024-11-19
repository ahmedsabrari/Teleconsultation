# 📞 Téléconsultation

**A telemedicine platform designed to provide seamless virtual healthcare services.**  
Built with **Laravel** (Backend), **React** (Frontend), and **MySQL** (Database).  
Empowering patients and doctors to connect remotely with secure and reliable tools.

---

## 🚀 Features

✨ **User Management**:  
Register, log in, and manage accounts for patients and doctors.  

📅 **Appointment Scheduling**:  
Book, update, and cancel consultations effortlessly.  

🩺 **Medical Records Management**:  
Secure storage and retrieval of patient medical history.  

💬 **Virtual Consultations**:  
Communicate via video, audio, or chat from anywhere.  

🔔 **Notifications**:  
Get reminders and updates for appointments.  

💳 **Secure Payments**:  
Online payment processing for consultations and services.

---

## 📂 Project Structure

### 🛠 Backend (Laravel)
The backend provides robust API services, authentication, and database handling.

Directory structure:
```
backend/
├── app/
├── config/
├── database/
├── routes/
├── storage/
└── .env
```

### 🌐 Frontend (React)
A modern, responsive user interface built with React.

Directory structure:
```
frontend/
├── public/
├── src/
│   ├── components/
│   ├── pages/
│   ├── services/
│   ├── styles/
└── .env
```

### 🗄 Database
MySQL handles user data, appointments, and medical records.

---

## 🖥 Prerequisites

Before getting started, ensure you have the following installed:

- [PHP](https://www.php.net/) (8.1 or higher)  
- [Composer](https://getcomposer.org/)  
- [Node.js](https://nodejs.org/) (14 or higher)  
- [MySQL](https://www.mysql.com/)  
- [Docker](https://www.docker.com/) (optional for containerization)

---

## ⚙️ Installation

### 🛠 Backend (Laravel)
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/téléconsultation.git
   cd téléconsultation/backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the `.env` file:
   ```bash
   cp .env.example .env
   ```
   Update database credentials in `.env`.

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Start the Laravel server:
   ```bash
   php artisan serve
   ```

---

### 🌐 Frontend (React)
1. Navigate to the frontend directory:
   ```bash
   cd téléconsultation/frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the React development server:
   ```bash
   npm start
   ```

---

## 🌟 Usage

1. **Start the backend server**:  
   Laravel will run on `http://localhost:8000`.

2. **Start the frontend server**:  
   React will run on `http://localhost:3000`.

3. Open your browser and access the app at:  
   `http://localhost:3000`

---

## 📊 API Endpoints

### 🔐 Authentication
- `POST /api/register`: Register a new user.  
- `POST /api/login`: Log in a user.  

### 📅 Appointments
- `GET /api/appointments`: Fetch user appointments.  
- `POST /api/appointments`: Create a new appointment.  
- `PUT /api/appointments/{id}`: Update an appointment.  
- `DELETE /api/appointments/{id}`: Cancel an appointment.  

### 🩺 Medical Records
- `GET /api/records`: Retrieve medical records.  
- `POST /api/records`: Add a new medical record.

---

## 🛠 Technologies Used

| **Technology**    | **Purpose**                            |
|--------------------|----------------------------------------|
| Laravel            | Backend API services                  |
| React              | Frontend user interface               |
| MySQL              | Database management                   |
| Docker (Optional)  | Containerization                      |
| Postman            | API testing                           |
| Git                | Version control                       |

---

## 🤝 Contributing

Contributions are welcome! 🎉  

To contribute:  
1. **Fork the repository**.  
2. **Create a new branch** for your feature/bug fix.  
3. **Commit your changes** and push them to your fork.  
4. **Submit a pull request**.  

---

## 📜 License

This project is licensed under the **MIT License**.  
See the `LICENSE` file for details.

---

## 📞 Contact

For any questions or support, feel free to reach out:  

- **Ahmed Sabrari**  
- ✉️ Email: sabrari.ahmed0@gmail.com  
- 💼 LinkedIn: [Ahmed Sabrari](https://www.linkedin.com/in/ahmedsabrari/)

---

## 📸 Screenshots (Optional)

## 📊 Diagrams

### Use Case Diagram
Voici le diagramme des cas d'utilisation pour le projet Téléconsultation :

![Use Case Diagram](https://drive.google.com/uc?id=1HkZjRHMr16ZC2Gw_uyKR3q9yL5yKdwwM)

### Class Diagram
Voici le diagramme des classes pour le projet Téléconsultation :

![Class Diagram](https://drive.google.com/uc?id=1O5eAnPrF6WNfGkc4N245wBkXC0DGYmgb)





