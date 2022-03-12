<script lang="ts">
  import { onMount } from "svelte";
  import { navigate } from "svelte-routing";
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { authUserInfo } from "../stores/authUserInfo";
  import { isLogin } from "../stores/loginStatus";

  onMount(() => {
    if ($isLogin === false) {
      navigate('/login', { replace: true });
    }
  });
</script>

<Header />

<h1>記事投稿フォーム</h1>

<form>
  <dl>
    <input type="hidden" name="user_id" value={$authUserInfo.id}>
    <dt><label for="title">タイトル</label></dt>
    <dd><input type="text" name="title" id="title" placeholder="タイトル"></dd>
    <dt><label for="body">本文</label></dt>
    <dd><textarea name="body" id="body" cols="30" rows="10" placeholder="本文"></textarea></dd>
  </dl>
  <button type="submit">投稿する</button>
</form>

<Footer />

<style lang="scss">
  input,
  textarea,
  button {
    border: 1px solid #ccc;
  }
</style>