<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { axios } from "../lib/axios";

  export let id: string;
  
  async function getPost() {
    const res = await axios.get(`http://localhost:8000/api/posts/${id}`);
    return res.data
  }

  let promise = getPost();
</script>

<Header />

{#await promise}
  <p>Loading...</p>
{:then post} 
  <h1 class="font-bold">{post.title}</h1>
  <p>{post.body}</p>
{:catch error}
  <p>情報が取得できませんでした...</p>
{/await}

<Footer />

<style lang="scss">

</style>