<script lang="ts">
  import { navigate } from "svelte-routing";
  import { axios } from "../lib/axios";
  import { authUserInfo } from "../stores/authUserInfo";
  import AnchorButton from "./atom/AnchorButton.svelte";
  import DeleteButton from "./atom/DeleteButton.svelte";
  import EditButton from "./atom/EditButton.svelte";

  export let post;

  async function del() {
    if (!confirm('この記事を削除しますか?')) {
      return;
    }
    await axios.get('http://localhost:8000/sanctum/csrf-cookie');
    await axios.delete(`http://localhost:8000/api/posts/${post.id}/destroy`);
    navigate('/', { replace: true });
  }
</script>

<li class="border p-2">
  <h1 class="font-bold"><AnchorButton path={`/posts/${post.id}`}>{post.title}</AnchorButton></h1>
  <nav>
    <p>by {post.user.name}</p>
    {#if $authUserInfo.id == post.user_id}
    <AnchorButton path={`/posts/${post.id}/edit`}>
      <EditButton />
    </AnchorButton>
    <button on:click={del}>
      <DeleteButton />
    </button>
    {/if}
  </nav>
</li>

<style lang="scss">
  nav {
    display: flex;
    justify-content: space-between;
  }
</style>