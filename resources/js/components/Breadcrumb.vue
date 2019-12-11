<template>
  <div class="container">
    <div class="row">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
          <li class="breadcrumb-item"><a href="/">Главная</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ itemname }}</li>
        </ol>
      </nav>
    </div>
  </div>
</template>

<script>
  export default {
    name:  'Breadcrumb',
    props: ['itemname'],
  }
</script>
