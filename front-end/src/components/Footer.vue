<template>
  <footer class="footer">
    <div class="footer-copyright">
      <b>{{ year }}, PULSES</b>
    </div>
  </footer>
</template>

<script>
import dayjs from 'dayjs'
export default {
  name: 'Footer',
  computed: {
    year () {
      return dayjs().year()
    }
  }
}
</script>

<style scoped>
.footer {
position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 60px;
  background-color: #fafafa;
  color: black;
  text-align: center;
}
</style>