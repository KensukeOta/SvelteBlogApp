<script lang="ts">
  import AnchorButton from "./atom/AnchorButton.svelte";

  export let post;
</script>

<li class="border p-2">
  <h1 class="font-bold"><AnchorButton path={`/posts/${post.id}`}>{post.title}</AnchorButton></h1>
  <p>by {post.user.name}</p>
</li>

<style lang="scss">

</style>