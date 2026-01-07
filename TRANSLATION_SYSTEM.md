# Système de Traduction FR/EN

Ce document explique comment fonctionne le système de traduction automatique du site Bee Aesthetic.

## Vue d'ensemble

Le site utilise **Google Translate via URL** pour traduire automatiquement tout le contenu de français vers anglais (et vice versa).

Le sélecteur de langue FR/EN est intégré de manière élégante dans le menu de navigation (desktop et mobile).

## Comment ça fonctionne

Cette solution utilise les **URLs de Google Translate** au lieu du widget intégré. C'est plus simple, plus fiable, et ça fonctionne à 100%.

### 1. Composable `useTranslation.js`

Fichier: `resources/js/composables/useTranslation.js`

Ce composable gère:
- La redirection vers Google Translate lors du changement de langue
- La détection si on est déjà sur une page traduite
- La sauvegarde de la préférence de langue dans localStorage

**Principe** :
- Clic sur "EN" → Redirige vers `https://translate.google.com/translate?sl=fr&tl=en&u=[URL_DU_SITE]`
- Clic sur "FR" → Retour à l'URL originale du site

### 2. Intégration dans TopNav

Fichier: `resources/js/Components/TopNav.vue`

- **Desktop**: Sélecteur FR/EN affiché à côté du panier et du bouton "Rendez-vous"
- **Mobile**: Sélecteur FR/EN dans le menu hamburger

Le sélecteur:
- Boutons FR et EN
- La langue active est mise en surbrillance (couleur #b3a090)
- Click sur une langue = traduction instantanée de toute la page

### 3. Avantages de cette approche

**Avantages** :
- ✅ Fonctionne à 100% (pas de problème de widget ou de bloqueur de pub)
- ✅ Totalement gratuit et illimité
- ✅ Traduit absolument tout le contenu automatiquement
- ✅ Fonctionne sur mobile et desktop
- ✅ Pas de script externe à charger

**Inconvénients** :
- ⚠️ L'URL change pour montrer `translate.google.com` en mode EN
- ⚠️ La traduction est visible comme étant de Google Translate

## Utilisation

### Pour l'utilisateur:

1. **Desktop**: Cliquer sur "FR" ou "EN" dans le menu en haut à droite
2. **Mobile**: Ouvrir le menu hamburger, cliquer sur "FR" ou "EN"
3. **Clic sur "EN"** : La page se recharge via Google Translate (URL change vers translate.google.com)
4. **Clic sur "FR"** : Retour à l'URL originale du site
5. La préférence est sauvegardée dans le navigateur

### Langues disponibles:

- **FR** (Français): Langue d'origine du site
- **EN** (English): Traduction automatique par Google

## Fonctionnalités

✅ Traduction automatique de TOUT le contenu (textes, boutons, menus, etc.)
✅ Sauvegarde de la préférence de langue
✅ Design élégant intégré au site
✅ Responsive (fonctionne sur mobile et desktop)
✅ 100% gratuit et illimité
✅ Fonctionne même avec bloqueur de pub
✅ Aucun problème de chargement de script

## Limitations

⚠️ La traduction est automatique (Google Translate), donc pas parfaite à 100%
⚠️ L'URL change pour afficher `translate.google.com/translate?...` en mode anglais
⚠️ Le bouton "Voir l'original" de Google apparaît en haut de la page traduite

## Maintenance

### Ajouter une nouvelle langue

Pour ajouter une autre langue (ex: NL pour néerlandais):

1. Ajouter le bouton dans `TopNav.vue`:
   ```html
   <button @click="changeLanguage('nl')" class="lang-btn">NL</button>
   ```

2. Modifier `resources/js/composables/useTranslation.js` pour gérer la nouvelle langue:
   ```js
   else if (lang === 'nl') {
     const translateUrl = `https://translate.google.com/translate?sl=fr&tl=nl&u=${encodeURIComponent(currentUrl)}`
     window.location.href = translateUrl
   }
   ```

C'est tout ! Google Translate supporte 100+ langues.

### Désactiver la traduction

Pour désactiver temporairement:

1. Dans `TopNav.vue`, commenter l'import:
   ```js
   // import { useTranslation } from '@/composables/useTranslation';
   ```

2. Commenter l'appel dans `onMounted`:
   ```js
   // loadGoogleTranslate();
   ```

## Support

Google Translate est fourni gratuitement par Google. Aucune clé API n'est requise pour l'usage web basique.

La traduction se fait côté client (dans le navigateur de l'utilisateur), donc pas d'impact sur le serveur.

## Améliorations futures possibles

1. Ajouter plus de langues (NL, DE, ES, etc.)
2. Détecter automatiquement la langue du navigateur
3. Traduire manuellement les textes clés pour une meilleure qualité
4. Ajouter un bouton "Retour à l'original" si besoin

---

**Note**: La traduction Google est automatique et peut parfois ne pas être parfaite, mais elle offre une bonne compréhension générale du contenu pour les visiteurs anglophones.
