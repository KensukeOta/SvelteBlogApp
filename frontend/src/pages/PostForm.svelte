<script lang="ts">
  import { onMount } from "svelte";
  import { navigate } from "svelte-routing";
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { authUserInfo } from "../stores/authUserInfo";
  import { isLogin } from "../stores/loginStatus";
  import { validator } from "@felte/validator-yup";
  import * as yup from "yup";
  import { createForm } from "felte";
  import { axios } from "../lib/axios";

  let errorMsg: string;

  onMount(() => {
    if (!$isLogin) {
      navigate('/login', { replace: true });
    }
  });

  yup.setLocale({
    mixed: {
      required: "必須項目です"
    },
  });

  const schema = yup.object({
    title: yup.string().required().max(50, "50文字以内で入力してください"),
    body: yup.string().required().max(1000, "1000文字以内で入力してください"),
  });

  const { form, errors } = createForm({
    initialValues: {
      title: "",
      body: "",
      user_id: `${$authUserInfo.id}`
    },
    extend: validator({ schema }),
    onSubmit: async (values) => {
      try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie');
        await axios.post('http://localhost:8000/api/store', {title: values.title, body: values.body, user_id: values.user_id});
        navigate('/', { replace: true });
      } catch (error) {
        errorMsg = error.response.data.message;
      }
    },
  });
</script>

<Header />

<h1>記事投稿フォーム</h1>

<form use:form>
  {#if errorMsg}
    <p class="valid-msg">{errorMsg}</p>
  {/if}
  <dl>
    <input type="hidden" name="user_id" id="user_id">
    <dt><label for="title">タイトル</label></dt>
    <dd><input type="text" name="title" id="title" placeholder="タイトル"></dd>
    {#if $errors.title}
      <p class="valid-msg">{$errors.title}</p>
    {/if}
    <dt><label for="body">本文</label></dt>
    <dd><textarea name="body" id="body" cols="30" rows="10" placeholder="本文"></textarea></dd>
    {#if $errors.body}
      <p class="valid-msg">{$errors.body}</p>
    {/if}
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