<script lang="ts">
  import { Link } from "svelte-routing";
  import { isLogin } from '../stores/loginStatus';
  import LogoutButton from "./atom/LogoutButton.svelte";
</script>

<header>
  <Link to="/">
    <h1>SvelteBlogApp</h1>
  </Link>

  <nav>
    {#if $isLogin}
      <LogoutButton />
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