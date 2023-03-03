
import {createApp} from "vue";
import Welcome from "./Welcome.vue";
import Registro from "./Registro.vue"
import Antecedente from "./Antecedente.vue";
import Hosp from "./Hosp.vue"
import Diagn from "./Diagn.vue"
import Odontograma from "./Odontograma.vue"

createApp(Welcome).mount("#app");
createApp(Registro).mount("#registro");
createApp(Antecedente).mount('#antecedente');
createApp(Hosp).mount("#hosp");
createApp(Diagn).mount("#diagn");
createApp(Odontograma).mount("#odontograma");
""
