<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { isLogin } from "../stores/loginStatus";
</script>

<Header />

<h1>Home</h1>

<p>ログイン状態： {$isLogin}</p>

<Footer />

<style lang="scss">

</style>