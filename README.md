# AI Assisted Task Management System

## Overview

AI Assisted Task Management System is a production-ready Laravel application built using Clean Architecture, Repository Pattern, Service Layer architecture, and AI integration.

The application helps teams manage tasks efficiently while leveraging AI to generate summaries and suggest priorities.

---

# Tech Stack

- Laravel 10+
- PHP 8.2+
- MySQL
- Blade + Tailwind CSS
- REST APIs
- OpenAI Integration
- Laravel Breeze Authentication

---

# Features

## Authentication & Roles

- User Authentication
- Admin Role
- User Role
- Role-based Authorization

---

# Task Management

## Task Fields

| Field | Type |
|---|---|
| title | string |
| description | text |
| priority | enum |
| status | enum |
| due_date | date |
| assigned_to | user_id |
| ai_summary | text |
| ai_priority | enum |

---

# Architecture

```txt
Controller
   ↓
Service Layer
   ↓
Repository Layer
   ↓
Database
```

---

# Folder Structure

```txt
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Resources/
│
├── Models/
│
├── Repositories/
│   ├── Contracts/
│   └── Eloquent/
│
├── Services/
│
├── Policies/
│
├── Providers/
│
└── Enums/
```

---

# Repository Pattern

## Interface

```php
interface TaskRepositoryInterface
{
    public function all(array $filters = []);

    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
```

---

# Service Layer

The Service Layer contains:
- business logic
- transactions
- AI integration
- repository communication

Example:

```php
class TaskService
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {

            $task = $this->repo->create($data);

            $aiData = $this->aiService
                ->generateSummary($task);

            $this->repo->update(
                $task->id,
                $aiData
            );
        });
    }
}
```

---

# AI Integration

## AIService Responsibilities

- Prompt creation
- API communication
- Response parsing
- Error handling
- Mock fallback support

---

# AI Workflow

```txt
Task Created
     ↓
TaskService
     ↓
AIService
     ↓
OpenAI API
     ↓
AI Response
     ↓
Database Updated
```

---

# Example AI Prompt

```txt
Analyze the following task.

Title:
Implement payment API

Description:
Complete Razorpay integration and test callbacks.

Return:
1. Short summary
2. Suggested priority
```

---

# REST APIs

| Method | Endpoint |
|---|---|
| GET | /api/tasks |
| POST | /api/tasks |
| PATCH | /api/tasks/{id}/status |
| GET | /api/tasks/{id}/ai-summary |

---

# Security

- Laravel Policies
- Authorization Gates
- Validation via Form Requests
- Role-based Access Control
- CSRF Protection

---

# Dashboard Analytics

Dashboard includes:
- Total Tasks
- Completed Tasks
- Pending Tasks
- High Priority Tasks
- Charts using Chart.js

---

# Installation

## Clone Repository

```bash
git clone repository-url
```

## Install Dependencies

```bash
composer install
npm install
```

## Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

## Database Migration

```bash
php artisan migrate
```

## Run Application

```bash
php artisan serve
npm run dev
```

---

# Queue Worker

```bash
php artisan queue:work
```

---

# Future Improvements

- AI deadline prediction
- Kanban board
- Notifications
- Docker support
- CI/CD pipeline
- Redis caching
- WebSocket real-time updates

---

# Conclusion

This project demonstrates:
- Clean Laravel architecture
- Repository Pattern
- Service Layer
- AI Integration
- REST APIs
- Production-ready structure