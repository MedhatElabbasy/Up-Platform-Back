
<template>
  <div>
    <link href="https://unpkg.com/@blueprintjs/icons@4/lib/css/blueprint-icons.css" rel="stylesheet"/>
    <link href="https://unpkg.com/@blueprintjs/core@4/lib/css/blueprint.css" rel="stylesheet"/>
    <link href="https://unpkg.com/@blueprintjs/popover2@1/lib/css/blueprint-popover2.css" rel="stylesheet"/>
    <div id="polotno"></div>
  </div>
</template>
<script>
import { createDemoApp } from './polotno/polotno-app';//customize
export default {
  name: 'App',
  data() {
    return {
      // store: null,
    };
  },
  mounted() {
    const { store } = createDemoApp({
      container: document.getElementById('polotno'),
      key: 'g8FnxJMsl2V92uxp6zITsssss',
      showCredit: false
    });
    this.store = store;
  },
};
</script>

<style>
#polotno {
  width: 100vw;
  height: 100vh;
}
body {
  padding: 0;
  margin: 0;
}
</style>




