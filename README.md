# DOCS

<h2>Autenticação</h2>

<h3><strong>POST</strong> /api/register</h3>

<h4>Exemplo de request:</h4>

```bash
{
    "name": "teste",
    "password": "pass12345",
    "password_confirmation": "pass12345"
}
```

<h4>Respostas:</h4>

201 CREATED

```bash
{
    "user": {
        "name": "teste",
        "updated_at": "2022-07-04T11:52:28.000000Z",
        "created_at": "2022-07-04T11:52:28.000000Z",
        "id": 1
    }
}
```

400 BAD REQUEST

```bash
{
    "error": {
        "name": [
            "The name has already been taken."
        ],
        "password": [
            "The password confirmation does not match."
        ]
    }
}
```

<h3><strong>POST</strong> /api/login</h3>

<h4>Exemplo de request:</h4>

```bash
{
    "name": "teste",
    "password": "pass12345"
}
```

<h4>Respostas:</h4>

200 OK

```bash
{
    "jwt": "7|LFb2HXF4IZjUaCifSgcetOrNg4PdQSPyHplJD4NV"
}
```

Nota: O jwt já vai para os cookies automaticamente, sem precisar enviar manualmente no request após fazer login. Dura 30 dias.

400 BAD REQUEST

```bash
{
    "error": {
        "password": [
            "The password field is required."
        ]
    }
}
```

401 UNAUTHORIZED

```bash
{
    "error": "Dados inválidos."
}
```

<h3><strong>POST</strong> /api/logout</h3>

<h4>Respostas:</h4>

200 OK

```bash
{
    "message": "Logout realizado com sucesso."
}
```

<h3><strong>GET</strong> /api/user</h3>

<h4>Respostas:</h4>

200 OK

```bash
{
    "user": {
        "id": 1,
        "name": "teste",
        "created_at": "2022-07-03T14:12:01.000000Z",
        "updated_at": "2022-07-03T14:12:01.000000Z"
    }
}
```

<h2>Coisas</h2>

<h3><strong>GET</strong> /api/things</h3>

<h4>Respostas:</h4>

200 OK

```bash
{
    "things": {
        "current_page": 1,
        "data": [
            {
                "user_id": 1,
                "one": "one1",
                "two": "two",
                "three": "three",
                "id": 3,
                "created_at": "2022-07-04T11:01:55.000000Z",
                "updated_at": "2022-07-04T11:06:27.000000Z"
            }
        ],
        "first_page_url": "http://0.0.0.0:8000/api/things?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://0.0.0.0:8000/api/things?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://0.0.0.0:8000/api/things?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://0.0.0.0:8000/api/things",
        "per_page": 15,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}
```

<h3><strong>POST</strong> /api/things</h3>

<h4>Exemplo de request:</h4>

```bash
{
    "one": "one",
    "two": "two",
    "three": "three"
}
```

<h4>Respostas:</h4>

201 CREATED

```bash
{
    "thing": {
        "user_id": 1,
        "one": "one",
        "two": "two",
        "three": "three",
        "updated_at": "2022-07-04T12:19:56.000000Z",
        "created_at": "2022-07-04T12:19:56.000000Z",
        "id": 4
    }
}
```

400 BAD REQUEST

```bash
{
    "error": "Você só pode ter uma Coisa."
}
```

```bash
{
    "error": {
        "three": [
            "The three field is required."
        ]
    }
}
```

<h3><strong>GET</strong> /api/things/1</h3>

<h4>Respostas:</h4>

200 OK

```bash
{
    "thing": {
        "user_id": 1,
        "one": "one",
        "two": "two",
        "three": "three",
        "id": 3,
        "created_at": "2022-07-04T11:01:55.000000Z",
        "updated_at": "2022-07-04T11:01:55.000000Z"
    }
}
```

404 NOT FOUND

```bash
{
    "error": "Coisa do usuário id:1 não encontrada"
}
```

<h3><strong>PUT</strong> /api/things/1</h3>

<h4>Exemplo de request:</h4>

```bash
{
    "one": "one1"
}
```

<h4>Respostas:</h4>

200 OK

```bash
{
    "thing": {
        "user_id": 2,
        "one": "one1",
        "two": "two",
        "three": "three",
        "id": 4,
        "created_at": "2022-07-04T12:19:56.000000Z",
        "updated_at": "2022-07-04T12:26:53.000000Z"
    }
}
```

404 NOT FOUND

```bash
{
    "error": "Coisa do usuário id:1 não encontrada"
}
```

<h3><strong>DELETE</strong> /api/things/1</h3>

<h4>Respostas:</h4>

200 OK

```bash
{
    "message": "Coisa removida com sucesso"
}
```

404 NOT FOUND

```bash
{
    "error": "Coisa do usuário id:1 não encontrada"
}
```