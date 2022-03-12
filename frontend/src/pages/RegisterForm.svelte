<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { validator } from "@felte/validator-yup";
  import * as yup from "yup";
  import { createForm } from "felte";
  import { axios } from "../lib/axios";
  import { isLogin } from "../stores/loginStatus";
  import { authUserInfo } from "../stores/authUserInfo";
  import { navigate } from "svelte-routing";
  import { onMount } from "svelte";

  let errorMsg: string;

  onMount(() => {
    if ($isLogin) {
      navigate('/', { replace: true });
    }
  });

  yup.setLocale({
    mixed: {
      required: "必須項目です",
    },
    string: {
      email: "有効なメールアドレス形式である必要があります",
    }
  });

  const schema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().required(),
    password_confirmation: yup.string().required().oneOf([yup.ref('password')], 'パスワードが一致しません'),
  });

  const { form, errors } = createForm({
    initialValues: {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    },
    extend: validator({ schema }),

    onSubmit: async (values) => {
      try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie');
        await axios.post('http://localhost:8000/api/register', { name: values.name, email: values.email, password: values.password, password_confirmation: values.password_confirmation});
        const res = await axios.post('http://localhost:8000/login', { email: values.email, password: values.password });
        isLogin.update(n => n = !n);
        authUserInfo.update(n => n = res.data);
        navigate("/", { replace: true });
      } catch (error) {
        errorMsg = error.response.data.message;
      }
    },
  });
</script>

<Header />

<h1>ユーザー登録フォーム</h1>

<form use:form>
  {#if errorMsg}
    <p class="valid-msg">{errorMsg}</p>
  {/if}
  <dl>
    <dt><label for="name">名前</label></dt>
    <dd><input type="text" name="name" id="name" placeholder="名前"></dd>
    {#if $errors.name}
      <p class="valid-msg">{$errors.name}</p>
    {/if}
    <dt><label for="email">メールアドレス</label></dt>
    <dd><input type="email" name="email" id="email" placeholder="メールアドレス"></dd>
    {#if $errors.email}
      <p class="valid-msg">{$errors.email}</p>
    {/if}
    <dt><label for="password">パスワード</label></dt>
    <dd><input type="password" name="password" id="password" placeholder="パスワード"></dd>
    {#if $errors.password}
      <p class="valid-msg">{$errors.password}</p>
    {/if}
    <dt><label for="password_confirmation">パスワード確認</label></dt>
    <dd><input type="password" name="password_confirmation" id="password_confirmation" placeholder="パスワード確認"></dd>
    {#if $errors.password_confirmation}
      <p class="valid-msg">{$errors.password_confirmation}</p>
    {/if}
  </dl>
  <button type="submit">登録する</button>
</form>

<Footer />

<style lang="scss">
  input,
  button {
    border: 1px solid #ccc;
  }
</style>