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

Currently, tokens are issued via the web login interface or can be generated manually by a Super Admin.
*(Future implementation: `POST /api/login` endpoint)*

## Endpoints

### Core Endpoints

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/user` | Get authenticated user details. |

### Module Endpoints

The generic pattern for module APIs is `/api/v1/{module}/{resource}`.

#### Projects
| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/v1/project` | List all projects. |
| POST | `/api/v1/project` | Create a new project. |
| GET | `/api/v1/project/{id}` | Get project details. |
| PUT | `/api/v1/project/{id}` | Update project. |
| DELETE | `/api/v1/project/{id}` | Delete project. |

#### Sales
| Method | Endpoint | Description |
| :--- | :--- | :--- |
| GET | `/api/v1/sales` | List sales records. |

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
