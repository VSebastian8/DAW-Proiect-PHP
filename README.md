# DAW-Proiect-PHP
**Scurta Descriere**
Site-ul va afisa date despre rezultatul diferitor concursuri sportive. Vor exista conturi de utilizator (autentificare prin formular) si de admin (poate adauga/sterge concursuri).

**Functionalitati**
- Se pot vizualiza concursurile dupa sport
- Se pot vizualiza cele mai recente concursuri
- Utilizatorii pot salva diferite concursuri; vor fi notificati cu update-uri pentru acestea
- Se poate accesa profilul unui sportiv, afisand concursurile la care a participat acesta
            
**Baza de Date**
- USERS(id, nume, prenume, email, parola)
- CONCURSURI(id, sport, data)
- SPORTIVI(id, nume, prenume, nationalitate)
- A_PARTICIPAT(id_sportiv, id_concurs, rezultat, premiu)
- NOTIFICARI(id_user, id_concurs)
