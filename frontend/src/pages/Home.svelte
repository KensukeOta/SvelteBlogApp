<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { authUserInfo } from "../stores/authUserInfo";
  import { isLogin } from "../stores/loginStatus";
</script>

<Header />

<h1>Home</h1>

<p>ログイン状態： {$isLogin}</p>

<p>Welcome! {$authUserInfo ? $authUserInfo.name : "stranger"}</p>

<Footer />

<style lang="scss">

</style>