import { ref, computed } from 'vue';

// État global du panier (partagé entre tous les composants)
const cartItems = ref([]);

// Charge le panier depuis localStorage au démarrage
const loadCart = () => {
  try {
    const saved = localStorage.getItem('bee_cart');
    if (saved) {
      const parsed = JSON.parse(saved);
      // Vérifie que c'est bien un tableau
      if (Array.isArray(parsed)) {
        cartItems.value = parsed;
      } else {
        console.warn('Panier corrompu dans localStorage, réinitialisation');
        cartItems.value = [];
        localStorage.removeItem('bee_cart');
      }
    }
  } catch (error) {
    console.error('Erreur lors du chargement du panier:', error);
    cartItems.value = [];
    localStorage.removeItem('bee_cart');
  }
};

// Sauvegarde le panier dans localStorage
const saveCart = () => {
  try {
    localStorage.setItem('bee_cart', JSON.stringify(cartItems.value));
  } catch (error) {
    console.error('Erreur lors de la sauvegarde du panier:', error);
  }
};

// Variable pour suivre si le panier a été initialisé
let initialized = false;

export function useCart() {
  // Charge le panier au premier appel (une seule fois)
  if (!initialized) {
    loadCart();
    initialized = true;
  }

  // Ajouter un produit au panier
// Ajouter un produit au panier
const addToCart = (product, quantity = 1) => {
    // S'assure que cartItems est un tableau
    if (!Array.isArray(cartItems.value)) {
      cartItems.value = [];
    }
  
    const existingItem = cartItems.value.find(item => item.id === product.id);
  
    if (existingItem) {
      // Produit déjà dans le panier → augmente la quantité
      existingItem.quantity += quantity;
    } else {
      // Nouveau produit
      cartItems.value.push({
        id: product.id,
        name: product.name,
        slug: product.slug,
        price: parseFloat(product.price),
        image: product.image,
        type: product.type, // ✅ AJOUTE LE TYPE
        quantity: quantity
      });
    }
  
    saveCart();
  };

  // Retirer un produit du panier
  const removeFromCart = (productId) => {
    if (!Array.isArray(cartItems.value)) {
      cartItems.value = [];
      return;
    }

    cartItems.value = cartItems.value.filter(item => item.id !== productId);
    saveCart();
  };

  // Modifier la quantité
  const updateQuantity = (productId, quantity) => {
    if (!Array.isArray(cartItems.value)) {
      cartItems.value = [];
      return;
    }

    const item = cartItems.value.find(item => item.id === productId);
    if (item) {
      if (quantity <= 0) {
        removeFromCart(productId);
      } else {
        item.quantity = quantity;
        saveCart();
      }
    }
  };

  // Vider le panier
  const clearCart = () => {
    cartItems.value = [];
    saveCart();
  };

  // Total du panier
  const cartTotal = computed(() => {
    if (!Array.isArray(cartItems.value)) {
      return 0;
    }

    return cartItems.value.reduce((total, item) => {
      const price = parseFloat(item.price) || 0;
      const quantity = parseInt(item.quantity) || 0;
      return total + (price * quantity);
    }, 0);
  });

  // Nombre d'articles
  const cartCount = computed(() => {
    if (!Array.isArray(cartItems.value)) {
      return 0;
    }

    return cartItems.value.reduce((count, item) => {
      const quantity = parseInt(item.quantity) || 0;
      return count + quantity;
    }, 0);
  });

  return {
    cartItems,
    cartTotal,
    cartCount,
    addToCart,
    removeFromCart,
    updateQuantity,
    clearCart
  };
}