# Specificații de Cerințe Software
## Specificații de Cerințe Software
Galatanu Emilia and Popoiu Andra

Universitatea Alexandru Ioan Cuza Facultatea de Informatica

Video demonstrativ: https://youtu.be/NhdxSL2w1kc

## Cuprins

1. [Introducere](#1-introducere)
   - 1.1 [Scop](#11-scop)

2. [Descriere Generală](#2-descriere-generală)
   - 2.1 [Perspectiva Produsului](#21-perspectiva-produsului)
   - 2.2 [Funcțiile Produsului](#22-funcțiile-produsului)
   - 2.3 [Clasele și Caracteristicile Utilizatorilor](#23-clasele-și-caracteristicile-utilizatorilor)
   - 2.4 [Mediul de Operare](#24-mediul-de-operare)

3. [Interfețe Utilizator](#3-interfețe-utilizator)
   - 3.1 [Conexiuni cu alte componente software](#31-conexiuni-cu-alte-componente-software)

4. [Funcționalități ale Sistemului](#4-funcționalități-ale-sistemului)
   - 4.1 [Pagina principală](#41-pagina-principală)
   - 4.2 [Vizualizarea actorilor](#42-vizualizarea-actorilor)
   - 4.3 [Vizualizarea anilor în care s-au desfășurat premiile](#43-vizualizarea-anilor-în-care-s-au-desfășurat-premiile)
   - 4.4 [Vizualizarea premiilor acordate într-un an specific](#44-vizualizarea-premiilor-acordate-într-un-an-specific)
   - 4.5 [Vizualizarea unui actor](#45-vizualizarea-unui-actor)
   - 4.6 [Vizualizarea unui film](#46-vizualizarea-unui-film)
   - 4.7 [Vizualizarea unui TV Show](#47-vizualizarea-unui-tv-show)
   - 4.8 [Vizualizarea unui sezon dintr-un serial](#48-vizualizarea-unui-sezon-dintr-un-serial)
   - 4.9 [Vizualizarea unui episod dintr-un serial](#49-vizualizarea-unui-episod-dintr-un-serial)
   - 4.10 [Vizualizarea statisticilor](#410-vizualizarea-statisticilor)
   - 4.11 [Login](#411-login)
   - 4.12 [Pagina administratorului](#412-pagina-administratorului)
   - 4.13 [Căutare](#413-căutare)


## 1. Introducere

### 1.1 Scop
Platforma are ca scop furnizarea accesului pentru utilizatori la o colecție bogată de informații privind nominalizările și premiile acordate actorilor și filmelor din diferiți ani. Obiectivul fundamental este de a crea o resursă centralizată și ușor accesibilă pentru utilizatori, permițându-le să exploreze și să analizeze evoluția și performanța actorilor și filmelor.

## Descriere Generală
### 2.1 Perspectiva Produsului

Software-ul descris în acest document cuprinde un set de pagini web interconectate, proiectate pentru a crea o experiență utilizator unitară pentru o platformă multimedia de divertisment. Aceste pagini web includ:

 -Pagina principală: Pagina de destinație principală a platformei.
 -Actori: O pagină care afișează o lista cu actorii care au participat la premii.
 -Ani: O pagină care clasifică conținutul pe ani.
 -An: O pagină care oferă detalii despre un an specific cine au fost cei nominalizati si castigarorii la fiecare categorie.
 -Actor: O pagină care oferă detalii despre un actor specific cum ar fi biografia, filmele si serialele in care acesta a jucat.
 -Film: Pagina care ofera destaliile specifice ale unui film, cine a jucat, regizori, data lansarii, etc.
 -Tv Show: Este asemănătoare cu pagina de film, ceea ce o distinge este faptul că putem vedea care este ultimul sezon apărut.
 -Sezoane: Este pagina care ne arată detalii despre un sezon dintr-un serial.
 -Episoade: Este pagina care ne detaliază episoadele.
 -Statistici: În momentul în care ne aflam pe pagina de ani, putem vedea statisticile la premii din tot acel an, sau daca ne aflăm pe pagina unui an specific vor fi afisate statistici pentru anul respectiv.
 -Login: Este pagina în care administratorii se pot loga. 
 -Admin: Este pagina în care administratorii pot modifica date din tabela userilor sau a premiilor. 


### 2.2 Funcțiile Produsului
Utilizatorii pot:

 -Căuta actori și filme
 -Vizualiza informații despre actori și filme
 -Filtra conținutul după an și nume


### 2.3 Clasele și Caracteristicile Utilizatorilor

În cadrul acestui produs, se anticipează următoarele clase de utilizatori:

1. Utilizatori obișnuiți:
    - Aceștia sunt utilizatorii principali ai sistemului și nu necesită un cont pentru a accesa funcționalitățile.
    - Utilizatorii obișnuiți pot căuta actori și filme, vizualiza informații despre actori și filme, și filtra conținutul după an și nume.
    - Această clasă de utilizatori reprezintă cea mai importantă pentru satisfacerea cerințelor produsului.

2. Administratori:
    - Aceștia sunt utilizatori cu privilegii speciale care au acces la funcționalități suplimentare, cum ar fi modificarea datelor din tabela utilizatorilor sau a premiilor.
    - Administratorii pot accesa pagina de login și pagina de administrare pentru a gestiona datele sistemului.
    - Această clasă de utilizatori are un nivel mai ridicat de privilegii și responsabilități în cadrul produsului.

Distingem că utilizatorii obișnuiți sunt cei mai importanți pentru satisfacerea cerințelor produsului, în timp ce administratorii au un nivel mai ridicat de privilegii și responsabilități în cadrul sistemului.


### 2.4 Mediul de Operare
Aplicația este proiectată pentru a rula atât pe PC, cât și pe dispozitive mobile. Este necesară o conexiune la internet pentru a accesa paginile web și a recupera datele. Sistemele de operare suportate includ Windows, macOS, iOS și Android. Aplicația este compatibilă cu browserele web populare, cum ar fi Chrome, Firefox, Safari și Edge. Se recomandă instalarea celei mai recente versiuni a browserului web pentru performanță și compatibilitate optimă.

## 3.1 Interfețe Utilizator

Pentru a asigura o experiență utilizator coerentă și intuitivă, produsul software va avea următoarele caracteristici logice ale interfeței utilizator:

1. Bară de căutare: O bară de căutare va fi disponibilă în partea de sus a fiecărei pagini, permițând utilizatorilor să introducă numele actorului, un serial sau film anume.

2. Pagini detaliate pentru actori, filme și altele: Produsul software va avea pagini detaliate pentru actori, filme și alte entități relevante. Aceste pagini vor afișa informații detaliate, cum ar fi biografia actorului, filmografia, premiile și alte detalii relevante.

3. Butoane de navigare și link-uri: Interfața utilizator va include butoane de navigare și link-uri pentru a permite utilizatorilor să se deplaseze între diferite pagini și să acceseze funcționalități specifice.

4. Design responsiv: Interfața utilizator va fi proiectată pentru a fi compatibilă cu diferite dimensiuni de ecran și dispozitive, asigurându-se că utilizatorii pot accesa și utiliza produsul software în mod eficient indiferent de platforma pe care o utilizează.


## 3.2 Conexiuni cu alte componente software

Am folosit următoarele componente software:
1. REST API propriu dezvoltat in limbajul PHP: A fost utilizată pentru stocarea și gestionarea datelor despre actori, filme, premii și alte informații relevante. REST API-ul propriu dezvoltat a fost utilizat pentru a permite comunicarea între frontend și backend.

2. The Movie Database API: A fost utilizat pentru a obține informații suplimentare despre filme, actori și alte entități relevante. Acest API a furnizat date precum biografii, filmografii și alte detalii despre actori și filme.

3. News API: A fost utilizat pentru a obține știri de actualitate despre actori și industria filmului. Acest API a furnizat informații despre evenimente recente, interviuri și alte noutăți relevante.

Comunicarea între aceste componente software se realizează prin intermediul cererilor HTTP și a răspunsurilor JSON. Datele sunt transferate între frontend și backend prin intermediul acestor cereri și răspunsuri, iar informațiile necesare sunt extrase și utilizate în funcționalitățile sistemului.
Este important de menționat că implementarea mecanismului de partajare a datelor între componente software este realizată prin intermediul REST API-ului propriu dezvoltat. Acesta asigură transferul securizat și eficient al datelor între frontend și backend, respectând protocoalele API detaliate în documentația tehnică.

### 4.Funcționalități ale Sistemului

## 4.1 Pagina principală
4.1.1 Descriere
Pagina principală servește ca punctul de pornire al platformei, oferind utilizatorilor acces la diverse funcționalități și informații disponibile. 

4.1.2 Informații
Utilizatorul accesează URL-ul platformei.
Sistemul afișează pagina principală cu opțiuni de navigare către alte secțiuni.
Sistemul afiseaza fotografii de la premii din anii precedenti intr-un slide-show interactiv. 


## 4.2 Vizualizarea actorilor
4.2.1 Descriere
Pagina "Actori" afișează o listă cu actorii care au participat la premii. 

4.2.2 Informații
Utilizatorul selectează opțiunea "Actori" din meniul principal.
Sistemul recuperează și afișează lista actorilor din baza de date, intr-un format paginat, poate naviga între mai multe pagini afișate pentru a selecta actorul pe care dorește să-l vizualizeze.

4.2.3 Cerințe Funcționale
Sistemul trebuie să afișeze o listă cu actorii care au participat la premii.
Sistemul trebuie să permită utilizatorilor să selecteze un actor pentru a vizualiza detalii suplimentare.

## 4.3 Vizualizarea anilor în care s-au desfășurat decernarea premiilor.
4.3.1 Descriere
Pagina "Ani" clasifică conținutul pe ani, oferind o perspectivă istorică a premiilor.

4.3.2 Informații
Utilizatorul selectează opțiunea "Ani" din meniul principal.
Sistemul afișează o listă de ani disponibili.

4.3.3 Cerințe Funcționale
Sistemul trebuie să afișeze o listă de ani.
Sistemul trebuie să permită utilizatorilor să selecteze un an pentru a vizualiza detalii suplimentare.

## 4.4 Vizualizarea premiilor acordate într-un an specific
4.4.1 Descriere
Pagina "An" oferă detalii despre un an specific, inclusiv nominalizările și câștigătorii la fiecare categorie. 

4.4.2 Informații
Utilizatorul selectează un an din pagina "Ani".
Sistemul afișează detalii despre nominalizări și câștigători pentru anul selectat.
Sistemul ofera o activitate interactivă de a vedea aceste date, inițial este afișat caștigătorul la categoria respectivă, iar utilizatorul poate vedea nominalizații apăsând pe numele acestora.
Sistemul oferă și filtrare pe categorii, cum ar fi actori, film sau serrial.

4.4.3 Cerințe Funcționale
Sistemul trebuie să afișeze detalii despre nominalizările și câștigătorii pentru anul selectat.

## 4.5 Vizualizarea unui actor 
4.5.1 Descriere
Pagina "Actor" oferă detalii despre un actor specific, cum ar fi biografia, filmografia și premiile. 

4.5.2 Informații
Utilizatorul selectează un actor din pagina "Actori".
Sistemul afișează detalii despre actorul selectat, cum ar fi date personale, cele mai cunoscute filme în care acesta a jucat, dar și toata filmografia.
La secțiunea de filmografie exită și un filtru pentru a  vizualiza doar filmele sau doar serialele în care actorul a participat.

4.5.3 Cerințe Funcționale
Sistemul trebuie să afișeze biografia, filmografia și premiile actorului selectat.
Sistemul trebuie să permită utilizatorilor să acceseze detalii suplimentare despre filmele și serialele în care actorul a jucat.

## 4.6 Vizualizarea unui film
4.6.1 Descriere
Pagina "Film" oferă detalii specifice ale unui film, cum ar fi distribuția, regizorii și data lansării. 

4.6.2 Informații
Utilizatorul selectează un film din rezultatele căutării sau din pagina unui actor.
Sistemul afișează detalii despre filmul selectat, opțiunea de a vedea trailer-ul, si distribuția actorilor care au participat în film.

4.6.3 Cerințe Funcționale
Sistemul trebuie să afișeze distribuția, regizorii și data lansării filmului selectat.
Sistemul trebuie să permită utilizatorilor să acceseze detalii suplimentare despre actorii și regizorii implicați.

## 4.7 Vizualizarea unui TV Show
4.7.1 Descriere
Pagina "TV Show" oferă detalii similare cu pagina de film, dar include și informații despre ultimele sezoane apărute. 

4.7.2 Informații
Utilizatorul selectează un serial din rezultatele căutării sau alte pagini relevante.
Sistemul afișează detalii despre serialul selectat, inclusiv ultimele sezoane apărute.

4.7.3 Cerințe Funcționale
Sistemul trebuie să afișeze distribuția, regizorii și data lansării pentru serialul selectat.
Sistemul trebuie să afișeze informații despre ultimele sezoane apărute.

## 4.8 Vizualizarea unui sezon dint-un serial
4.8.1 Descriere
Pagina "Sezoane" arată detalii despre un sezon specific dintr-un serial. Este de prioritate medie.

4.8.2 Informații
Utilizatorul selectează un sezon din pagina "TV Show".
Sistemul afișează detalii despre sezonul selectat.

4.8.3 Cerințe Funcționale
Sistemul trebuie să afișeze detalii despre sezonul selectat, inclusiv lista episoadelor și alte informații relevante.

## 4.9 Vizualizarea unui episod dint-un serial
4.9.1 Descriere
Pagina "Episoade" detaliază informațiile despre episoadele unui sezon. Este de prioritate medie.

4.9.2 Informații
Utilizatorul selectează un episod din pagina "Sezoane".
Sistemul afișează detalii despre episodul selectat.

4.9.3 Cerințe Funcționale
Sistemul trebuie să afișeze detalii despre episodul selectat, inclusiv data difuzării, durata și un rezumat.

## 4.10 Vizualizarea statisticilor
4.10.1 Descriere
Pagina "Statistici" afișează statistici despre premii pentru toți anii sau pentru un an specific. 

4.10.2 Informații
Utilizatorul selectează opțiunea "Statistici" din meniul principal.
Sistemul afișează statistici relevante despre premiile din toți anii sau dintr-un an specific.
Sistemul oferă trei tipuri de statistici, Pie, Bar si Tabular Chart, și permite utilizatorilor să descarce acele statistici în formate CSV, WebP si SVG.

4.10.3 Cerințe Funcționale
Sistemul trebuie să afișeze statistici despre premii, incluzând câștigători, nominalizări și să permită descărcarea acestora.

## 4.11 Login
4.11.1 Descriere
Pagina "Login" permite administratorilor să se autentifice. 

4.11.2 Informații
Administratorul accesează pagina de login.
Sistemul solicită credențiale (utilizator și parolă).
Administratorul introduce credențialele.
Sistemul verifică credențialele și autentifică administratorul.

4.11.3 Cerințe Funcționale
Sistemul trebuie să furnizeze un formular de autentificare.
Sistemul trebuie să valideze credențialele administratorilor.
Sistemul trebuie să permită recuperarea parolei în caz de uitare.

## 4.12 Vizualizarea paginii administratorului
4.12.1 Descriere
Pagina "Admin" permite administratorilor să modifice datele din tabelele utilizatorilor și premiilor.

4.12.2 Informații
Administratorul se autentifică și accesează pagina de administrare.
Sistemul afișează opțiuni pentru modificarea datelor utilizatorilor și premiilor.
Pentru a fi accesată aceasta pagină trebuie să fie autentificat.

4.12.3 Cerințe Funcționale
Sistemul trebuie să permită administratorilor să vizualizeze și să editeze datele utilizatorilor.
Sistemul trebuie să permită administratorilor să vizualizeze și să editeze datele premiilor.
Sistemul trebuie să înregistreze toate modificările efectuate de administratori.


## 4.13 Căutare

4.12.1 Descriere: Funcționalitatea de căutare permite utilizatorilor să găsească rapid informații despre actori, filme și seriale în baza de date a platformei. 

4.13.2 Informații
Utilizatorul introduce un termen de căutare în bara de căutare (de exemplu, numele unui actor, titlul unui film sau al unui serial).
Sistemul caută în baza de date informațiile relevante legate de termenul introdus.
Sistemul afișează rezultatele căutării într-un format ușor de navigat pentru utilizator.

4.13.3 Cerințe Funcționale:
Sistemul trebuie să ofere o bara de căutare vizibilă și accesibilă pe toate paginile platformei.
Sistemul trebuie să permită căutarea în baza de date pentru actori, filme și seriale.
Rezultatele căutării trebuie să fie afișate rapid și să includă informații relevante precum biografia actorilor, detalii despre filmele și serialele găsite.
Utilizatorii trebuie să poată filtra și sorta rezultatele căutării în funcție de relevanță, an, gen etc., pentru o navigare mai ușoară și mai precisă.
