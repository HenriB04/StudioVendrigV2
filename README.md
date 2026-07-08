# Studio Vendrig — website V2

Vernieuwde vormgeving van [www.studiovendrig.nl](https://www.studiovendrig.nl), volledig in PHP.
Alle inhoud (projecten, nieuws, studio, samenwerking, contactgegevens) is 1-op-1 overgenomen
van de originele website.

## Lokaal draaien

Vereist: PHP (staat op deze machine in `C:\php`).

```
C:\php\php.exe -S localhost:8010 -t C:\StudioVendrigV2
```

Open daarna in de browser: **http://localhost:8010**

Stoppen: `Ctrl+C` in het terminalvenster.

## Structuur

| Bestand | Inhoud |
|---|---|
| `index.php` | Homepage met heroslider, diensten, uitgelichte projecten en nieuws |
| `projecten.php` | Projectoverzicht met categoriefilter |
| `project.php?id=…` | Projectdetail met fotogalerij en lightbox |
| `studio.php` | Over Studio Vendrig |
| `nieuws.php` (`?id=…`) | Nieuwsarchief en artikelen |
| `samenwerking.php` | Studio In Motion |
| `contact.php` | Contactgegevens en formulier (berichten komen in `berichten.log`) |
| `includes/data.php` | Alle projectdata |
| `includes/news.php` | Alle nieuwsberichten |
| `includes/functions.php` | Configuratie (contactgegevens, navigatie) en helpers |

## Vormgeving V2

Donkere, editorial stijl: Fraunces (display-serif) met Manrope, warm papier-wit,
houtskool en een koperkleurig accent. Genummerde secties, grote typografie,
scroll-reveal-animaties en een fullscreen heroslider.
