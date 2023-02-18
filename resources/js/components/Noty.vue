<template>
  <div class="alert alert-success alert-noty" :class="type" v-if="notification">
    <span class="text-center">
      {{ notification.message }}
    </span>
  </div>
</template>
<script>
export default {
  created() {
    this.emitter.on("notification", (payload) => {
      this.notification = payload;
      setTimeout(() => {
        this.notification = null;
      }, 2500);
    });
  },
  data() {
    return {
      notification: null,
    };
  },
  computed: {
    type() {
      return `alert-${this.notification.type}`;
    },
  },
};
</script>

<style>
.alert-noty {
  position: fixed;
  bottom: 30px;
  right: 20px;
  z-index: 1;
}
</style>
