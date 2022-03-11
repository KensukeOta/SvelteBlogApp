<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { createForm } from 'felte';
  import { validator } from '@felte/validator-yup';
  import * as yup from 'yup';
  import { axios } from "../lib/axios";
  import { isLogin } from "../stores/loginStatus";
  import { navigate } from "svelte-routing";
  import { authUserInfo } from "../stores/authUserInfo";

  let errorMsg: string;

  yup.setLocale({
    mixed: {
      required: "必須項目です",
    },
    string: {
      email: "有効なメールアドレス形式である必要があります"
    }
  });

  const schema = yup.object({
    email: yup.string().email().required(),
    password: yup.string().required(),
  });

  const { form, errors } = createForm({
    initialValues: {
      email: "",
      password: ""
    },
    extend: validator({ schema }),
    
    onSubmit: async (values) => {
      try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie');
        const res = await axios.post('http://localhost:8000/login', { email: values.email, password: values.password });
        isLogin.update(n => n = !n);
        authUserInfo.update(n => n = res.data);
        navigate("/", { replace: true });
      } catch (error) {
        errorMsg = error.response.data.message;
      }
    }
  })
</script>

<Header />

<h1>ログインフォーム</h1>

<form use:form>
  {#if errorMsg}
    <p class="valid-msg">{errorMsg}</p>
  {/if}
  <dl>
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
  </dl>
  <button type="submit">ログイン</button>
</form>

<Footer />

<style lang="scss">
  input,
  button {
    border: 1px solid #ccc;
  }
</style>