<script lang="ts">
import { Link } from "svelte-routing";
</script>

<header>
  <Link to="/">
    <h1>SvelteBlogApp</h1>
  </Link>

  <nav>
    <Link to="/signup">新規登録</Link>
    <Link to="/login">ログイン</Link>
  </nav>
</header>

<style lang="scss">
  header {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid $theme-color;
  }
</style>