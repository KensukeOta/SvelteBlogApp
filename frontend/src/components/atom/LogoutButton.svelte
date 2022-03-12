<script lang="ts">
  import { axios } from "../../lib/axios";
  import { navigate } from "svelte-routing";
  import { authUserInfo } from "../../stores/authUserInfo";
  import { isLogin } from "../../stores/loginStatus";

  async function logout() {
    await axios.get('http://localhost:8000/sanctum/csrf-cookie');
    await axios.post('http://localhost:8000/logout');
    isLogin.update(n => n = !n);
    authUserInfo.update(n => n = "");
    navigate("/login", { replace: true });
  }
</script>

<button on:click={logout}>ログアウト</button>

<style lang="scss">

</style>