import { ref, computed } from 'vue'
import fr from '@/lang/fr'
import en from '@/lang/en'

const currentLanguage = ref(localStorage.getItem('language') || 'fr')

const translations = {
  fr,
  en,
}

export function useTranslation() {
  const t = computed(() => {
    return translations[currentLanguage.value] || translations.fr
  })

  const changeLanguage = (lang) => {
    if (lang === 'fr' || lang === 'en') {
      currentLanguage.value = lang
      localStorage.setItem('language', lang)
      console.log(`Language changed to: ${lang}`)
    }
  }

  const loadGoogleTranslate = () => {
    // Pas besoin de charger quoi que ce soit avec la traduction manuelle
  }

  return {
    t,
    currentLanguage,
    changeLanguage,
    loadGoogleTranslate,
  }
}
