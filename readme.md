# Symfony Transaction Manager

A practice project built with **Symfony**, applying **Clean Architecture** and **CQRS (Command Query Responsibility Segregation)** principles. This application helps you manage your personal finances by tracking **income** and **expense** transactions on a **monthly or yearly** basis.

## 🧱 Architecture

This project follows Clean Architecture, separating concerns into clear layers:

- **Domain**: Business rules and entities
- **Application**: Use cases through CQRS (Commands and Queries) and application interfaces for external services
- **Infrastructure**: External services, like client calls and persistence
- **Presentation**: HTTP controllers and request/response handling

## 📦 Features

- Authentication system
- Keeping track of income and expenses, without a bank integration
- See how much you earn/spend and what your income to expense ratio is
- Organized using **CQRS**: separate models for reading and writing
- Built using **Symfony 7.2**

## 🚀 Getting Started

### Prerequisites

- PHP 8.4+
- Composer
- Symfony CLI (optional but recommended)
- PostgreSQL or any database supported by Doctrine

### Installation

```bash
git clone https://github.com/NickyMatthijssen/symfony-bill-manager.git
cd symfony-transaction-manager
composer install
npm install
```