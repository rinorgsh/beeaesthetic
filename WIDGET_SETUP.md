# Guide d'installation du Widget Google Reviews

Ce guide vous explique comment installer un widget Google Reviews sur votre site en **3 minutes chrono**.

---

## Option 1 : POWR.io (100% GRATUIT - Recommandé)

### Étape 1 : Créer le widget (2 minutes)

1. **Allez sur** : https://www.powr.io/plugins/google-reviews/live

2. **Personnalisez votre widget** :
   - Cliquez sur "Edit"
   - Connectez votre compte Google (juste pour identifier votre page business)
   - Sélectionnez "Bee Aesthetic" dans la liste de vos établissements
   - Personnalisez :
     - **Layout** : Choisir "Grid" ou "Slider"
     - **Couleurs** : Adapter à votre charte (#b3a090)
     - **Nombre d'avis** : Afficher 6-12 avis

3. **Récupérez le code** :
   - Cliquez sur "Publish" en haut à droite
   - Choisissez "Copy Code"
   - Vous obtiendrez 2 lignes comme :
   ```html
   <script src="https://www.powr.io/powr.js"></script>
   <div class="powr-google-reviews" id="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"></div>
   ```

### Étape 2 : Installer le widget (1 minute)

1. Ouvrez le fichier : `resources/js/Components/ReviewsSection.vue`

2. Trouvez la section (ligne ~27) :
   ```html
   <!-- WIDGET À INSÉRER ICI -->
   <p class="widget-placeholder">
     Le widget Google Reviews sera affiché ici une fois configuré.
   ```

3. **Remplacez** le paragraphe `<p class="widget-placeholder">...</p>` par le code POWR que vous avez copié

4. **Exemple final** :
   ```html
   <!-- WIDGET À INSÉRER ICI -->
   <script src="https://www.powr.io/powr.js"></script>
   <div class="powr-google-reviews" id="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"></div>
   ```

5. **Sauvegardez** le fichier

6. **Rechargez** votre site - Les avis s'affichent automatiquement ! ✅

---

## Option 2 : Elfsight (Version gratuite avec branding)

### Gratuit avec "Powered by Elfsight" affiché

1. **Allez sur** : https://elfsight.com/google-reviews-widget/

2. **Créez le widget** :
   - Cliquez sur "Create Widget for Free"
   - Créez un compte gratuit
   - Connectez votre compte Google
   - Sélectionnez "Bee Aesthetic"
   - Personnalisez le design

3. **Copiez le code** fourni (2 lignes) :
   ```html
   <script src="https://static.elfsight.com/platform/platform.js" async></script>
   <div class="elfsight-app-xxxxx-xxxxx"></div>
   ```

4. **Collez le code** dans `ReviewsSection.vue` (même emplacement que POWR)

### Version payante (Optionnel - ~$6/mois)
- Pas de branding "Powered by Elfsight"
- Vues illimitées
- Plus d'options de personnalisation

---

## Option 3 : Widget Google Maps Embed (100% Gratuit - Simple mais basique)

Si vous voulez juste un truc ultra simple :

1. **Trouvez votre page Google Business** sur Google Maps

2. **Cliquez sur "Partager"** puis **"Intégrer une carte"**

3. **Copiez le code iframe** fourni

4. **Collez-le** dans `ReviewsSection.vue` à la place du placeholder

**Limitations** :
- Design moins personnalisable
- Affiche la carte + les avis (pas juste les avis)
- Moins élégant visuellement

---

## Vérification

Après installation, visitez : http://votre-site.com (ou localhost)

➜ Les avis Google devraient s'afficher automatiquement dans la section reviews !

---

## Besoin d'aide ?

**Problème** : Le widget ne s'affiche pas
- Vérifiez que vous avez bien sauvegardé le fichier
- Rechargez la page avec CTRL+F5 (ou CMD+SHIFT+R sur Mac)
- Ouvrez la console du navigateur (F12) pour voir les erreurs

**Problème** : "Établissement non trouvé"
- Vérifiez que votre page Google Business est bien publique et vérifiée
- Assurez-vous d'avoir des avis publiés sur votre page

---

## Recommandation

🎯 **Je recommande POWR.io** car :
- ✅ 100% gratuit (pas de branding gênant)
- ✅ Design professionnel
- ✅ Facile à personnaliser
- ✅ Met à jour automatiquement les nouveaux avis
- ✅ Responsive (s'adapte au mobile)

Temps total : **3-4 minutes maximum !**
