<template>
    <div>
      <TopNav />
      
      <section class="admin-section">
        <div class="container">
          <!-- Header -->
          <div class="page-header">
            <Link href="/admin/products" class="back-link">← Retour</Link>
            <h1 class="page-title">Modifier le produit</h1>
          </div>
          <div class="page-divider"></div>
  
          <!-- Formulaire -->
          <form @submit.prevent="submit" class="product-form">
            <!-- Nom -->
            <div class="form-group">
              <label>Nom du produit</label>
              <input
                v-model="form.name"
                type="text"
                required
                placeholder="Ex: Guide de la Manucure Parfaite"
              />
            </div>
  
            <!-- Description courte -->
            <div class="form-group">
              <label>Description courte</label>
              <input
                v-model="form.short_description"
                type="text"
                placeholder="Une courte phrase accrocheuse"
              />
            </div>
  
            <!-- Description complète -->
            <div class="form-group">
              <label>Description complète</label>
              <textarea
                v-model="form.description"
                required
                rows="6"
                placeholder="Description détaillée du produit"
              ></textarea>
            </div>
  
            <!-- Prix et Type -->
            <div class="form-row">
              <div class="form-group">
                <label>Prix (€)</label>
                <input
                  v-model="form.price"
                  type="number"
                  step="0.01"
                  min="0"
                  required
                  placeholder="15.00"
                />
              </div>
  
              <div class="form-group">
                <label>Type</label>
                <select v-model="form.type">
                  <option value="digital">Digital</option>
                  <option value="physical">Physique</option>
                </select>
              </div>
            </div>
  
            <!-- Image actuelle -->
            <div v-if="product.image" class="form-group">
              <label>Image actuelle</label>
              <div class="current-image">
                <img :src="`/storage/${product.image}`" :alt="product.name" />
              </div>
            </div>
  
            <!-- Nouvelle image -->
            <div class="form-group">
              <label>{{ product.image ? 'Changer l\'image' : 'Image du produit' }}</label>
              <input
                type="file"
                accept="image/*"
                @change="handleImageUpload"
                class="file-input"
              />
              <p class="input-hint">JPG, PNG (max 2MB)</p>
            </div>
  
            <!-- Fichier actuel (digital) -->
            <div v-if="form.type === 'digital' && product.file_path" class="form-group">
              <label>Fichier actuel</label>
              <p class="file-info">✅ Fichier uploadé</p>
            </div>
  
            <!-- Nouveau fichier (digital seulement) -->
            <div v-if="form.type === 'digital'" class="form-group">
              <label>{{ product.file_path ? 'Changer le fichier' : 'Fichier téléchargeable' }}</label>
              <input
                type="file"
                accept=".pdf,.zip"
                @change="handleFileUpload"
                class="file-input"
              />
              <p class="input-hint">PDF, ZIP (max 10MB)</p>
            </div>
  
            <!-- Actif -->
            <div class="form-group">
              <label class="checkbox-container">
                <input
                  v-model="form.is_active"
                  type="checkbox"
                  class="checkbox-input"
                />
                <span class="checkbox-custom"></span>
                <span class="checkbox-label-text">Produit actif (visible sur le site)</span>
              </label>
            </div>
  
            <!-- Boutons -->
            <div class="form-actions">
              <Link href="/admin/products" class="btn-cancel">
                Annuler
              </Link>
              <button type="submit" :disabled="form.processing" class="btn-submit">
                <span v-if="form.processing">Enregistrement...</span>
                <span v-else>Mettre à jour</span>
              </button>
            </div>
          </form>
        </div>
      </section>
  
      <Footer />
    </div>
  </template>
  
  <script setup>
  import { useForm, Link } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  
  const props = defineProps({
    product: Object
  });
  
  const form = useForm({
    name: props.product.name,
    description: props.product.description,
    short_description: props.product.short_description || '',
    price: props.product.price,
    type: props.product.type,
    is_active: props.product.is_active,
    image: null,
    file: null
  });
  
  const handleImageUpload = (event) => {
    form.image = event.target.files[0];
  };
  
  const handleFileUpload = (event) => {
    form.file = event.target.files[0];
  };
  
  const submit = () => {
    form.post(`/admin/products/${props.product.id}`, {
      forceFormData: true,
      preserveScroll: true,
      onError: (errors) => {
        console.error('Erreurs:', errors);
      }
    });
  };
  </script>
  
  <style scoped>
  .admin-section {
    padding: 3rem 0 6rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    min-height: 80vh;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 2rem;
  }
  
  .page-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
  }
  
  .back-link {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    transition: color 0.3s ease;
  }
  
  .back-link:hover {
    color: #333;
  }
  
  .page-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 1px;
  }
  
  .page-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin-bottom: 3rem;
  }
  
  /* Formulaire */
  .product-form {
    background: white;
    padding: 3rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }
  
  .form-group {
    margin-bottom: 2rem;
  }
  
  /* ✅ Labels normaux seulement (pas checkbox) */
  .form-group > label:not(.checkbox-container) {
    display: block;
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
    margin-bottom: 0.8rem;
    letter-spacing: 0.3px;
  }
  
  /* Inputs normaux */
  .form-group input[type="text"],
  .form-group input[type="number"],
  .form-group input[type="file"],
  .form-group select,
  .form-group textarea {
    width: 100%;
    padding: 0.9rem 1.2rem;
    border: 1px solid #ddd;
    background: #fafafa;
    font-size: 0.95rem;
    font-weight: 300;
    color: #333;
    font-family: 'Montserrat', sans-serif;
    transition: all 0.3s ease;
  }
  
  .form-group input[type="text"]:focus,
  .form-group input[type="number"]:focus,
  .form-group input[type="file"]:focus,
  .form-group select:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #b3a090;
    background: white;
  }
  
  .form-group textarea {
    resize: vertical;
    line-height: 1.6;
  }
  
  .input-hint {
    font-size: 0.8rem;
    color: #999;
    margin-top: 0.5rem;
    font-weight: 300;
  }
  
  /* Current Image */
  .current-image {
    width: 200px;
    height: 200px;
    overflow: hidden;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  .current-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  /* File Info */
  .file-info {
    font-size: 0.9rem;
    color: #4caf50;
    font-weight: 300;
  }
  
  /* Form Row */
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
  }
  
  /* File Input */
  .file-input {
    padding: 0.7rem 1rem !important;
    cursor: pointer;
  }
  
  /* ✅ Custom Checkbox - CORRIGÉ */
  .checkbox-container {
    display: inline-flex !important;
    align-items: center;
    gap: 1rem;
    cursor: pointer;
    user-select: none;
    padding: 0.5rem 0;
    margin: 0 !important;
  }
  
  .checkbox-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
  }
  
  .checkbox-custom {
    position: relative;
    height: 24px;
    width: 24px;
    min-width: 24px;
    border: 2px solid #999;
    background-color: white;
    transition: all 0.3s ease;
    flex-shrink: 0;
    border-radius: 3px;
  }
  
  .checkbox-container:hover .checkbox-custom {
    border-color: #666;
  }
  
  .checkbox-input:checked ~ .checkbox-custom {
    background-color: #333;
    border-color: #333;
  }
  
  .checkbox-custom::after {
    content: "";
    position: absolute;
    display: none;
    left: 7px;
    top: 3px;
    width: 6px;
    height: 11px;
    border: solid white;
    border-width: 0 2.5px 2.5px 0;
    transform: rotate(45deg);
  }
  
  .checkbox-input:checked ~ .checkbox-custom::after {
    display: block;
  }
  
  .checkbox-label-text {
    font-size: 0.95rem;
    font-weight: 300;
    color: #555;
    letter-spacing: 0.3px;
    line-height: 1.5;
  }
  
  /* Form Actions */
  .form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #f0f0f0;
  }
  
  .btn-cancel,
  .btn-submit {
    padding: 0.9rem 2rem;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
    text-decoration: none;
    border-radius: 50px;
    display: inline-block;
    text-align: center;
  }
  
  .btn-cancel {
    background: white;
    color: #666;
    border: 1px solid #ddd;
  }
  
  .btn-cancel:hover {
    background: #f5f5f5;
  }
  
  .btn-submit {
    background: #333;
    color: white;
  }
  
  .btn-submit:hover:not(:disabled) {
    background: #000;
    transform: translateY(-2px);
  }
  
  .btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
  
  /* Responsive */
  @media (max-width: 767px) {
    .product-form {
      padding: 2rem 1.5rem;
    }
  
    .page-title {
      font-size: 2rem;
    }
  
    .form-row {
      grid-template-columns: 1fr;
    }
  
    .form-actions {
      flex-direction: column-reverse;
    }
  
    .btn-cancel,
    .btn-submit {
      width: 100%;
    }
  }
  </style>