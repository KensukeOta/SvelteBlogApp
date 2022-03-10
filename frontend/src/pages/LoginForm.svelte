<script lang="ts">
  import Footer from "../components/Footer.svelte";
  import Header from "../components/Header.svelte";
  import { createForm } from 'felte';
  import { validator } from '@felte/validator-yup';
  import * as yup from 'yup';

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
    onSubmit: (values) => {
      console.log(values);
    }
  })
</script>

<Header />

<h1>ログインフォーム</h1>

<form use:form>
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