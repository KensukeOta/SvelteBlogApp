<script lang="ts">
  import { isLogin } from '../stores/loginStatus';
  import AnchorButton from "./atom/AnchorButton.svelte";
  import LogoutButton from "./atom/LogoutButton.svelte";
</script>

<header>
  <AnchorButton path="/">
    <h1>SvelteBlogApp</h1>
  </AnchorButton>

  <nav>
    {#if $isLogin}
      <LogoutButton />
    {:else}
      <AnchorButton path="/signup">新規登録</AnchorButton>
      <AnchorButton path="/login">ログイン</AnchorButton>
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