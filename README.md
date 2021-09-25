#### Symfony 4.4 REST API с JWT авторизацией пользователя
##### 1) Попытка доступа к данным без регистрации (наличия токена):
GET 178.62.205.95/api или GET 178.62.205.95/api/todo
<a href="https://ibb.co/HDn3kV2"><img src="https://i.ibb.co/LznH28P/1.png" alt="1" border="0"></a>
##### 2) Регистрация пользователя (добавление в базу данных):
curl -X POST 178.62.205.95/register -d _username=sveta -d _password=123456
<a href="https://ibb.co/8Bxmpmn"><img src="https://i.ibb.co/N3NFPFg/2.png" alt="2" border="0"></a>
##### 3) Получение токена пользователя для авторизации:
curl -X POST -H "Content-Type: application/json" 178.62.205.95/login_check -d '{"username":"sveta","password":"123456"}'
<a href="https://ibb.co/TbzFt1Z"><img src="https://i.ibb.co/k9YWXJp/3.png" alt="3" border="0"></a>
##### 4) Авторизация пользователя:
curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MzI1MzIwMjUsImV4cCI6MTYzMjUzNTYyNSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoic3ZldGEifQ.K_uic6kLN6rEAoHqVJ7yR_nzU7QEXLCfXvEX7JwAjgdai4uyqIBp94pk21ZHtkTC9EE3jJCICcMAbLlDhegdsHU_wGTu5eRRW3iUpIN9I0jl3nNU99ZwDgEek2Za16QRHRFJMCtziW2mjap-67sSXl6E1N_XdE66GDHqCbeu8vxML5Oq0i30QMFsvN7iMt-sMLIhOE0zFEpbmG_MR-KO2eFmSsjGoQostKag_lHSVQ0HmB-aejrwZVgemZ44YlFM2tpFGNYKCslFBW6j_GX12RpTnfyhmGN-70DsQ9dMGyIALMue5XFFY9h_SwI-6MAmMad0zNV7tea_chbHE3oWvw" 178.62.205.95/api
<a href="https://ibb.co/5WsfGmT"><img src="https://i.ibb.co/Fb8jm26/4.png" alt="4" border="0"></a>
##### 5) Получить список задач:
GET 178.62.205.95/api/todo
<a href="https://ibb.co/wC9cDcG"><img src="https://i.ibb.co/4M61B1v/5.png" alt="5" border="0"></a>
##### 6) Добавить задачу:
POST 178.62.205.95/api/todo
<a href="https://ibb.co/MSvpv7z"><img src="https://i.ibb.co/pw7Z7dH/6.png" alt="6" border="0"></a>
Добавим ещё одну задачу и проверим результат (по пункту 5):
<a href="https://ibb.co/x2Ww35V"><img src="https://i.ibb.co/Cwg4W0x/62.png" alt="62" border="0"></a>
##### 7) Обновить задачу:
PUT 178.62.205.95/api/todo/{id}
<a href="https://ibb.co/v1G0HMV"><img src="https://i.ibb.co/dBq8rHj/7.png" alt="7" border="0"></a>
Проверим результат (по пункту 5):
<a href="https://ibb.co/jM8wBq7"><img src="https://i.ibb.co/T8w0pJz/72.png" alt="72" border="0"></a>
##### 8) Удалить задачу:
DELETE 178.62.205.95/api/todo/{id}
<a href="https://ibb.co/mbjKb3r"><img src="https://i.ibb.co/HBSyBjL/8.png" alt="8" border="0"></a>
Проверим результат (по пункту 5):
<a href="https://ibb.co/7kKdrDS"><img src="https://i.ibb.co/9ZWky0p/82.png" alt="82" border="0"></a>