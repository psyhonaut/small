<template>
  <div>
    <div class="card-header d-flex justify-content-between">
      <div class="h6 m-0">
        {{ username }}
      </div>
      {{ date }}
    </div>
    <div class="card-body">
      <p class="card-text">{{ description }}</p>
    </div>
  </div>
</template>

<script>
  export default {
    name:  'TicketReply',
    props: ['username', 'date', 'description'],
  }
</script>
