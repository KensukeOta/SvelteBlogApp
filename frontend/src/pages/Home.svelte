<script lang="ts">
  import { Link } from "svelte-routing";
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { authUserInfo } from "../stores/authUserInfo";
  import { isLogin } from "../stores/loginStatus";
</script>

<Header />

<h1>Home</h1>

<p>ログイン状態： {$isLogin}</p>

<p>Welcome! {$authUserInfo ? $authUserInfo.name : "stranger"}</p>

<nav class="text-center">
  <Link to="/posts/create" class="p-2 bg-green-500 text-white hover:opacity-80">投稿する</Link>
</nav>

<Footer />

<style lang="scss">

</style>