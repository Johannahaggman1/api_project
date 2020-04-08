#  PROJEKT - SKAPA EN E-HANDEL

## Skapa databas 

1. Gå in på: https://github.com/Johannahaggman1/api_project.git
2. Gå in på "ecommerce.sql" filen och följ den för att återskapa databasen. 

## Namngivning 
Alla variabel/metod/objekt/variabler är namngivna med så beskrivande som möjligt, för att göra det enklare att förstå koden. 
Endpoints/metoder är döpta med camelcase. Variabler som används i samband med metoder är döpta $vartiabelnamn_IN eller $variabelnamn_param, 
för att göra det tydligt att de används i samband med metod/query:s.  

## Frontend
-> apitester.html 
Kan användas till att prova de olika funktionerna i projektet.  

## MAPPSTRUKTUR 

### CONFIG / database_handler 
Här sätts databasens inställningar och här ansluts även databasen. Det ska även finnas ett errormeddelande om anslutningen skulle misslyckas. 

### OBJECTS 
Här skapas och sparas klasser som kan hämtas och användas i de olika endpoint:sen, klasserna innehåller nödvändiga metoder och egenskaper för att 
kunna skapa olika funktionaliteter i projektet. 
- Orderrows: Innehåller det som hör till orderrader och kundvagnen
- Products: Innehåller det som rör produkthantering 
- Users: Innehåller det som rör kundhantering

### V1 / cart
I den här mappen ligger alla endpoints som hör till varukorgen.
- Checka ut varukorg
- Visa varukort : dvs de orderrader som ligger i varukorgen

### V1 / orderrow
I den här mappen ligger alla endpoints som hör till order rader, dvs. produkter som ligger i en varukorgen. 
- Lägga till orderrad 
- Radera orderrad 
- Uppdatera orderrad
- Visa specifik orderrad

### V1 / product 
I den här mappen ligger alla endpoints som hör till produkthantering.
- Lägga till produkt 
- Radera produkt 
- Uppdatera produkt 
- Visa produkt 
- Visa alla produkter 

### V1 / users 
I den här mappen ligger alla endpoints som hör till användarhantering.
- Logga in användare 
- Registrera användare

