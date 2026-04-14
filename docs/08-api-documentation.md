# API Documentation

Laravel SmartHR provides a RESTful API for external integrations and mobile application support.

## Authentication

The API uses **Laravel Sanctum** for authentication.

### Headers
All API requests must include the following headers:

```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer <your-token>
```

### Obtaining a Token

Tokens can be obtained by calling the login endpoint with valid credentials, or generated manually by a Super Admin via the admin panel.

## Endpoints

### Authentication
| Method | Endpoint | Description |
| :--- | :--- | :--- |
| POST | `/api/v1/login` | Authenticate user and get token. |
| POST | `/api/v1/logout` | Revoke current token (authenticated). |
| GET | `/api/v1/me` | Get authenticated user profile. |
| POST | `/api/v1/refresh-token` | Revoke current token and issue new one. |

#### POST /api/v1/login

**Request:**
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Response (200 OK):**
```json
{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com"
    },
    "token": "1|abc123..."
}
```

**Error (401 Unauthorized):**
```json
{
    "message": "Invalid credentials"
}
```

### Core Endpoints

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/v1/user` | Get authenticated user details. |

### Module Endpoints

API endpoints for modules are available under `/api/v1/`:

#### Projects
| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/v1/project` | List all projects. |
| POST | `/api/v1/project` | Create a new project. |
| GET | `/api/v1/project/{id}` | Get project details. |
| PUT | `/api/v1/project/{id}` | Update project. |
| DELETE | `/api/v1/project/{id}` | Delete project. |
| GET | `/api/v1/project/{id}/tasks` | List project tasks. |
| POST | `/api/v1/project/{id}/tasks` | Create a task in a project. |

## Responses

### Success (200 OK)
```json
{
    "data": {
        "id": 1,
        "name": "Website Redesign",
        "status": "In Progress"
    }
}
```

### Error (422 Unprocessable Entity)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```