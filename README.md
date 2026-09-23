# Projecte intermodular d'administració de sistemes (OBO/OER/LCA)

## Descripció
En aquesta activitat s'ha preparat un codi web mínim, s'ha registrat al repositori i s'ha corregit un bug funcional.

## Codi web
- `/home/runner/work/Projecte-intermodular-d-administraci-de-sistemes-OBO-OER-LCA/Projecte-intermodular-d-administraci-de-sistemes-OBO-OER-LCA/index.html`
- `/home/runner/work/Projecte-intermodular-d-administraci-de-sistemes-OBO-OER-LCA/Projecte-intermodular-d-administraci-de-sistemes-OBO-OER-LCA/script.js`

## Bug detectat i solució
**Problema:** la conversió d'anys a mesos retornava un resultat incorrecte.

**Causa:** la lògica de conversió estava mal plantejada (sumava 12 en lloc de multiplicar per 12).

**Solució aplicada:** s'ha implementat la funció `yearsToMonths(years)` amb:
- conversió segura de l'entrada a nombre,
- retorn de `0` en cas de valor no numèric,
- càlcul correcte `years * 12`.

## Verificació
S'ha executat una comprovació manual amb Node.js de la lògica principal:
- `yearsToMonths(2) -> 24`
- `yearsToMonths("3") -> 36`
- `yearsToMonths("abc") -> 0`

## Execució local (desplegament simple)
Des de l'arrel del repositori:

```bash
python3 -m http.server 8080
```

Després, obrir:
`http://localhost:8080`
