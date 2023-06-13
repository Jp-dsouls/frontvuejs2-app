export const nuevoItem = {
  name: "",
};
export const nuevoCategoria = {
  name: "",
  items: [],
};
export const dataInitMatrix = [
  {
    name: "0. Micellaneous",
    categories: [
      {
        name: "ECONOMICO",
        items: [
          {
            name: "Libre de publicidad",
            stakeholders: [],
            beneficiaries: [],
          },
          {
            name: "Ahorro de tiempo",
            stakeholders: [],
            beneficiaries: [],
          },
          {
            name: "Ahorro de energía",
            stakeholders: [],
            beneficiaries: [],
          },
          {
            name: "Ahorro de dinero",
            stakeholders: [],
            beneficiaries: [],
          },
        ],
      },
      {
        name: "ORGANIZACIONAL",
        items: [
          {
            name: "Mejora de reputación",
            stakeholders: [],
            beneficiaries: [],
          },
          {
            name: "Mejora de imagen corporativa",
            stakeholders: [],
            beneficiaries: [],
          },
        ],
      },
    ],
  },
  {
    name: "Objetivo 1. No a la pobreza",
    categories: [],
    items: [
      {
        name: "1.1 Erradicar la pobreza extrema",
        stakeholders: [],
        beneficiaries: [],
      },
      {
        name: "1.2 Reducir el número de personas",
        stakeholders: [],
        beneficiaries: [],
      },
    ],
  },
];

export const defaultStakeholders = [
  {
    actorSocial: "Stakeholder 1",
    color: "",
    comentarios: "asdasd",
    descripcion: "asdasd",
    proyectoId: "40",
  },
  {
    actorSocial: "Stakeholder 2",
    color: "",
    comentarios: "asdasd",
    descripcion: "asdasd",
    proyectoId: "40",
  },
  {
    actorSocial: "Stakeholder 3",
    color: "",
    comentarios: "asdasd",
    descripcion: "asdasd",
    proyectoId: "40",
  },
  {
    actorSocial: "Stakeholder 4",
    color: "",
    comentarios: "asdasd",
    descripcion: "asdasd",
    proyectoId: "40",
  },
];

export const defaultBeneficiaries = [
  {
    actor: "Beneficiario 1",
    comentarios: "asdasd",
    comunidad: "",
    descripcion: "asdasd",
    impactos: [
      { value: null, text: "Seleccione" },
      { value: "a", text: "Tipo A" },
      { value: "b", text: "Tipo B" },
    ],
    proyectoId: "40",
  },
  {
    actor: "Beneficiario 2",
    comentarios: "asdasd",
    comunidad: "",
    descripcion: "asdasd",
    impactos: [
      { value: null, text: "Seleccione" },
      { value: "a", text: "Tipo A" },
      { value: "b", text: "Tipo B" },
    ],
    proyectoId: "40",
  },
];

export const sizeCols = {
  categories: "400px",
  others: "125px",
};
