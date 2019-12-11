<template>
  <div>
    <form action="http://localhost:8888/small/public/">
    <div class="form-row text-right">
      <div class="form-group col-md-10">
        <div class="form-check">
          <input v-model="status" class="form-check-input" type="checkbox">
          <label class="form-check-label" for="status">
            Показать закрытые тикеты
          </label>
        </div>
      </div>

      <div class="form-group col-md-2">
        <select v-model="department" class="form-control">
          <option value="">Все отделы</option>
          <option value="1" >IT отдел</option>
          <option value="2" >Отдел продаж</option>
          <option value="3" >Финансовый отдел</option>
        </select>
      </div>
    </div>
    <button @click.prevent="fetch" class="btn btn-success">Отправить</button>
    </form>

    <div v-for="ticket in tickets">
      {{ ticket.title }}
    </div>

  </div>
</template>

<script>
    export default {

        data(){
          return{
            status: true,
            department: null,
            tickets: null,
          }
        },

        methods: {
          fetch(){
            axios.get('/', {
              params: {
                status: this.status,
                departmentID: this.department,
              }
            })
              .then(response => {
                this.tickets = response.data;
              })
          }
        },

        mounted() {
          this.fetch();
        }
    }
</script>
