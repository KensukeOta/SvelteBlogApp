<script lang="ts">
  import { Link } from "svelte-routing";
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { authUserInfo } from "../stores/authUserInfo";
  import { isLogin } from "../stores/loginStatus";
  import { axios } from "../lib/axios";
  import PostItem from "../components/PostItem.svelte";

  async function getPosts() {
    const res = await axios.get('http://localhost:8000/api/posts');
    return res.data
  }

  let promise = getPosts();
</script>

<Header />

<h1>Home</h1>

<p>ログイン状態： {$isLogin}</p>

<p>Welcome! {$authUserInfo ? $authUserInfo.name : "stranger"}</p>

<nav class="text-center">
  <Link to="/posts/create" class="p-2 bg-green-500 text-white hover:opacity-80">投稿する</Link>
</nav>

<ul class="mt-2">
  {#await promise}
    <p>Loading...</p>
  {:then posts} 
    {#each posts as post (post.id)}
      <PostItem title={post.title} author={post.user.name} />
    {/each}
  {:catch error}
    <p>情報が取得できませんでした...</p>
  {/await}
</ul>

<Footer />

<style lang="scss">

</style>