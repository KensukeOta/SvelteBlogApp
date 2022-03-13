<script lang="ts">
  import { authUserInfo } from "../stores/authUserInfo";
  import AnchorButton from "./atom/AnchorButton.svelte";
  import EditButton from "./atom/EditButton.svelte";

  export let post;
</script>

<li class="border p-2">
  <h1 class="font-bold"><AnchorButton path={`/posts/${post.id}`}>{post.title}</AnchorButton></h1>
  <nav>
    <p>by {post.user.name}</p>
    {#if $authUserInfo.id == post.user_id}
    <AnchorButton path={`/posts/${post.id}/edit`}>
      <EditButton />
    </AnchorButton>
    {/if}
  </nav>
</li>

<style lang="scss">
  nav {
    display: flex;
    justify-content: space-between;
  }
</style>