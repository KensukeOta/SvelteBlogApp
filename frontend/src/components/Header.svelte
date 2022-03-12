<script lang="ts">
  import { axios } from "../lib/axios";
  import { Link, navigate } from "svelte-routing";
  import { isLogin } from '../stores/loginStatus';
  import { authUserInfo } from "../stores/authUserInfo";

  async function logout() {
    await axios.get('http://localhost:8000/sanctum/csrf-cookie');
    await axios.post('http://localhost:8000/logout');
    isLogin.update(n => n = !n);
    authUserInfo.update(n => n = "");
    navigate("/login", { replace: true });
  }
</script>

<header>
  <Link to="/">
    <h1>SvelteBlogApp</h1>
  </Link>

  <nav>
    {#if $isLogin}
      <button on:click={logout}>ログアウト</button>
    {:else}
      <Link to="/signup">新規登録</Link>
      <Link to="/login">ログイン</Link>
    {/if}
  </nav>
</header>

<style lang="scss">
  header {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid $theme-color;
  }
</style>