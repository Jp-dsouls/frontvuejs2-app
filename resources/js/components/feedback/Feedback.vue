<template>
  <div>
    <div
      class="container px-0 pb-8 pt-5 pt-md-6 border-0"
      style="margin-top: 5rem !important"
    >
      <div class="row">
        <div
          class="col-lg-10 col-md-10 pt-2"
          style="background-color: #f5f5f5; width: 100px; height: 100%"
        >
          <div class="font-weight-light">
            <table
              class="table text-center"
              style="cursor: pointer; background-color: #fff"
            >
              <tr class="cellbackgr">
                <th colspan="2"><h3>Panel</h3></th>
              </tr>
              <tr class="border-primary">
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[0]" class="m-0">Proyecto</h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Proyecto'"
                      @click="addStickyNoteProyecto('modal-proyectos')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--Zone Drop-->
                  <div
                    id="content"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout"
                      :layout.sync="layout"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp-xl"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div @dblclick="editModal('modal-proyecto', item)">
                          <span
                            class="text textb p-2"
                            style="color: black !important; white-space: normal"
                          >
                            <strong>Proyecto:</strong>
                            {{
                              item.data.Proyecto.nombre !== ""
                                ? item.data.Proyecto.nombre
                                : item.data.Proyecto.nombre
                            }}<br />
                            <strong>Objetivos:</strong>
                            {{ item.data.Proyecto.objetivo }}
                            <br />
                            <strong>Componentes:</strong>
                            <ul class="list-group ml-4">
                              <li
                                v-for="itemComp in item.data.Proyecto
                                  .componentes"
                                :key="itemComp.id"
                              >
                                {{ itemComp.nombre }}
                              </li>
                            </ul>
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 1)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--End Zone Drop-->
                </td>
              </tr>
              <tr class="headt">
                <td class="border-right">
                  <div
                    class="card-body d-flex align-items-center bg-white"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[1]" class="m-0">Promotores</h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Promotor'"
                      @click="addStickyNotePromotor('modal-promotores')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>

                  <!--ZoneDrop-->
                  <div
                    id="content2"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout2"
                      :layout.sync="layout2"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout2.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout2"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <!-- EDITPROMOTOR -->
                        <div @dblclick="editModal('modal-promotor', item)">
                          <span
                            v-if="item.data.Promotor.actor === ''"
                            class="text textb p-2"
                            style="white-space: normal"
                          >
                            -- Click para agregar datos --</span
                          >
                          <span
                            v-if="item.data.Promotor.actorSocial !== ''"
                            class="text textb p-2"
                          >
                            {{ item.data.Promotor.actorSocial }}
                            <br /><br />
                            {{
                              item.data.Promotor.descripcion !== null
                                ? item.data.Promotor.descripcion
                                : "" | acorcad
                            }}
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 2)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
                <td>
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[2]" class="m-0">
                      Beneficiarios <strong>(+/-)</strong>
                    </h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Beneficiario'"
                      @click="addStickyNoteBeneficiario('modal-beneficiarios')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content3"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout3"
                      :layout.sync="layout3"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout3.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout3"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <!-- EDITPROMOTOR -->
                        <div @dblclick="editModal('modal-beneficiario', item)">
                          <span
                            v-if="item.data.Beneficiario.actor === ''"
                            class="text textb p-2"
                            style="white-space: normal"
                          >
                            -- Click para agregar datos --</span
                          >
                          <span
                            v-if="item.data.Beneficiario.actor !== ''"
                            class="text textb p-2"
                          >
                            {{ item.data.Beneficiario.actor }}
                            <br /><br />
                            {{ item.data.Beneficiario.descripcion | acorcad }}
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 3)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
              <!-- Responsabilidades -->
              <tr>
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[3]" class="m-0">
                      Responsabilidades
                    </h3>
                    <button
                      v-b-popover.hover.top="'Nueva Responsabilidad'"
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      @click="
                        addStickyNoteResponsabilidad('modal-responsabilidades')
                      "
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content4"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout4"
                      :layout.sync="layout4"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout4.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout4"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div
                          @dblclick="editModal('modal-responsabilidades', item)"
                        >
                          <span
                            v-if="selPromResponsabilidad == null"
                            class="text textb p-2"
                            style="white-space: normal"
                            >-- Click para agregar datos --</span
                          >
                          <span
                            v-if="selPromResponsabilidad != null"
                            class="text textb p-2"
                          >
                            {{ selPromResponsabilidad }} <br /><br />
                            {{
                              item.data.Responsabilidad.responsable | acorcad
                            }}
                            <br /><br />
                            {{
                              item.data.Responsabilidad.comentarios | acorcad
                            }}
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 4)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[4]" class="m-0">
                      Recursos Sociales
                    </h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Recurso Social'"
                      @click="addStickyNoteRecursoSocial('modal-recursos')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content5"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout5"
                      :layout.sync="layout5"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout5.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout5"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div @dblclick="editModal('modal-recurso', item)">
                          <span
                            v-if="selRecursoSocial === null"
                            class="text textb p-2"
                            style="white-space: normal"
                            >-- Click para agregar datos --</span
                          >
                          <span
                            v-if="item.data !== null"
                            class="text textb p-2"
                          >
                            {{ selRecursoSocial }}
                            <br /><br />
                            {{ item.data.Recurso.comentarios | acorcad }}</span
                          >
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 5)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[5]" class="m-0">
                      Mecanismo Diálogo
                    </h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Mecanismo de Diálogo'"
                      @click="addStickyNoteMecanismoDialogo('modal-dialogos')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content6"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout6"
                      :layout.sync="layout6"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout6.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout6"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp-lg"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div @dblclick="editModal('modal-dialogo', item)">
                          <span
                            v-if="item.data.Dialogo.comentario == ''"
                            class="text textb p-2"
                            style="white-space: normal"
                          >
                            -- Click para agregar datos --
                          </span>
                          <span
                            v-if="item.data.Dialogo.comentario != ''"
                            class="text textb p-2"
                            >{{ item.data.Dialogo.comentario | acorcad }} <br />
                            <ul class="list-group ml-3">
                              <li
                                v-for="itemComp in item.data.Dialogo.selected"
                                :key="itemComp"
                              >
                                {{ itemComp }}
                              </li>
                            </ul>
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 6)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[6]" class="m-0">
                      Gestión de la Comunidad
                    </h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nueva Gestión de la Comunidad'"
                      @click="addStickyNoteGestionComunidad('modal-gestiones')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content7"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout7"
                      :layout.sync="layout7"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout7.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout7"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp-sm"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div @dblclick="editModal('modal-compromiso', item)">
                          <span
                            v-if="item.data.Compromiso.comentario == ''"
                            class="text textb p-2"
                            style="white-space: normal"
                            >-- Click para agregar datos --</span
                          >
                          <span
                            v-if="item.data.Compromiso.comentario != ''"
                            class="text textb p-2"
                            >{{ item.data.Compromiso.comentario | acorcad }}
                            <br />
                            <ul class="list-group ml-3">
                              <li
                                v-for="itemComp in item.data.Compromiso
                                  .selected"
                                :key="itemComp"
                              >
                                {{ itemComp }}
                              </li>
                            </ul>
                          </span>
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 7)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div
                    class="card-body d-flex align-items-center"
                    style="gap: 10px"
                  >
                    <h3 v-b-popover="popOver[7]" class="m-0">
                      Beneficios <strong>(+/-)</strong>
                    </h3>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-success btn-sm text-left"
                      style="padding-left: 10px; padding-right: 10px"
                      v-b-popover.hover.top="'Nuevo Beneficio'"
                      @click="addStickyNoteBeneficio('modal-beneficios')"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                    <button
                      type="button"
                      class="btn base-button rounded-circle btn-sm text-left"
                      style="
                        padding-left: 10px;
                        padding-right: 10px;
                        background: #5e72e4;
                      "
                      v-b-popover.hover.top="'Ver Matriz'"
                    >
                      <i class="fas fa-eye text-white"></i>
                    </button>
                  </div>
                  <!--ZoneDrop-->
                  <div
                    id="content8"
                    style="width: 100%; margin-top: 10px; height: 100%"
                  >
                    <grid-layout
                      ref="gridlayout8"
                      :layout.sync="layout8"
                      :col-num="12"
                      :row-height="30"
                      :is-draggable="draggable"
                      :is-resizable="resizable"
                      :responsive="responsive"
                      :vertical-compact="true"
                      :use-css-transforms="true"
                      :style="layout8.length == 0 ? 'height: 120px' : ''"
                    >
                      <grid-item
                        v-for="item in layout8"
                        :key="item.i"
                        :static="item.static"
                        :x="item.x"
                        :y="item.y"
                        :w="item.w"
                        :h="item.h"
                        :i="item.i"
                        class="list-group-item list-group-item-action list-group-item-warning clamp"
                        style="
                          background-color: #feff9c !important;
                          text-align-last: start;
                        "
                      >
                        <div @dblclick="editModal('modal-rentabilidad', item)">
                          <span
                            v-if="selRentabilidadAS == null"
                            class="text textb p-2"
                            style="white-space: normal"
                            >-- Click para agregar datos --</span
                          >
                          <span
                            v-if="selRentabilidadAS != null"
                            class="text textb p-2"
                          >
                            {{ item.data.Rentabilidad.beneficio | acorcad }}
                            <br />
                            <br />{{
                              item.data.Rentabilidad.comentarios | acorcad
                            }}</span
                          >
                        </div>
                        <div>
                          <span class="remove" @click="removeItem(item.i, 8)"
                            >x</span
                          >
                        </div>
                      </grid-item>
                    </grid-layout>
                  </div>
                  <!--ZoneDrop-->
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!-- STICKY NOTE FLOATING -->
        <div class="col-lg-1 col-md-1 pt-3">
          <div class="sticky-note">
            <div
              v-for="(item, i) in stickyFloating"
              :key="i"
              style="position: relative"
            >
              <textarea
                class="stiky-note-floating p-2 mb-2"
                placeholder="Ingrese anotación"
              >
              </textarea>
              <button
                v-on:click="deleteStickyFloating()"
                style="
                  color: black;
                  position: absolute;
                  top: 0px;
                  left: 175px;
                  width: 18px;
                  height: 18px;
                  border: none;
                  background: rgb(249, 239, 175);
                  font-size: 15px;
                "
              >
                <i class="fa fa-minus-circle"></i>
              </button>
              <button
                v-on:click="saveStickyFloating()"
                style="
                  color: black;
                  position: absolute;
                  top: 20px;
                  left: 176px;
                  width: 18px;
                  height: 18px;
                  border: none;
                  background: rgb(249, 239, 175);
                  font-size: 15px;
                "
              >
                <i class="fa fa-save"></i>
              </button>
            </div>
          </div>
          <div
            id="create"
            class="d-flex align-items-center justify-content-center"
            v-on:click="touch()"
          >
            +
          </div>
        </div>
      </div>
    </div>
    <!-- SECCION DE MODALES -->
    <!--Modal Proyecto-->
    <b-modal
      id="m-proyecto"
      ref="modal-proyecto"
      title="Proyecto"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="proyecto" @submit.stop.prevent="handleSubmit">
        <b-form-group
          id="nombre-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Nombre:"
          label-for="nombreProyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="nombreProyecto"
            v-model="proyecto.nombre"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="colors-stiky-note"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Color stiky note:"
          label-for="colorStikyNote"
          label-size="sm"
          class="mr-1"
        >
          <b-form-radio-group id="colorStikyNote" class="d-flex">
            <!-- Radios in the default slot will appear after any option generated radios -->
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
          </b-form-radio-group>
        </b-form-group>
        <b-form-group
          id="objetivo-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Objetivo"
          label-for="objetivoProyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="objetivoProyecto"
            v-model="proyecto.objetivo"
          ></b-form-input>
        </b-form-group>

        <b-form-group
          id="attachment"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Archivo:"
          label-for="attachmentFile"
          label-size="sm"
          class=""
        >
          <b-form-file
            v-model="attachment"
            size="sm"
            class="form-control-sm"
            id="attachmentFile"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
        </b-form-group>

        <b-form-group
          id="componentes-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Componentes:"
          label-for="componentesProyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="componentesProyecto"
            v-model="proyecto.componente"
          ></b-form-input>
        </b-form-group>
        <button
          class="float-right btn btn-sm btn-success"
          @click="addComponente()"
        >
          <i class="fa fa-plus"></i> Agregar
        </button>
        <br /><br />
        <!--Tabla-->
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Componente</th>
              <th scope="col">---</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="itemc in proyecto.componentes" :key="itemc.id">
              <td>{{ itemc.id }}</td>
              <td>{{ itemc.nombre }}</td>
              <td>
                <button
                  class="btn btn-sm btn-danger"
                  @click="deleteComponente(itemc.id)"
                >
                  <i class="fa fa-minus-circle"></i>
                </button>
                <button
                  class="btn btn-sm btn-primary"
                  @click="editComponente(itemc.id)"
                  style="background: #5e72e4; border-color: #5e72e4"
                >
                  <i class="fa fa-pen-square text-white"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <!--Fin tabla-->
        <br />
        <b-form-group
          id="monto-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Monto"
          label-for="montoProyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            type="number"
            step=".01"
            id="montoProyecto"
            v-model="proyecto.monto"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="desc-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Descripción"
          label-for="descripcion-proyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="descripcion-proyecto"
            v-model="proyecto.descripcion"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="coord-proyecto"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Coordenadas"
          label-for="coordenadas-proyecto"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="coordenadas-proyecto"
            v-model="proyecto.coordenadas"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="cod-ubigeo"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Ubigeo"
          label-for="ubigeo"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="ubigeo"
            v-model="proyecto.ubigeo"
          ></b-form-input>
        </b-form-group>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                @click="handleOk(1)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                @click="hideModal('modal-proyecto')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Promotor-->
    <b-modal
      id="promotor"
      ref="modal-promotor"
      title="Promotor"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="promotor" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group
            id="actor-social"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Stakeholder"
            label-for="actsocial"
            label-size="sm"
            required
          >
            <b-form-input
              size="sm"
              id="actsocial"
              v-model="promotor.actorSocial"
              spellcheck="true"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="desc1-promotor"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Descripción"
            label-for="desc-promotor"
            label-size="sm"
          >
            <b-form-textarea
              id="desc-promotor"
              v-model="promotor.descripcion"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
          <b-form-group
            id="comen-promotor"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentario"
            label-for="comen-promotor"
            label-size="sm"
          >
            <b-form-textarea
              id="comen-promotor"
              v-model="promotor.comentarios"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                type="button"
                class="btn btn-sm float-left"
                variant="primary"
                @click="handleOk(2)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                type="button"
                class="btn btn-sm float-right"
                variant="danger"
                @click="hideModal('modal-promotor')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Beneficiarios-->
    <b-modal
      id="modal-benef"
      ref="modal-beneficiario"
      title="Beneficiario"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="beneficiario" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group
            id="actor-social"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Stakeholder"
            label-for="actor-beneficiario"
            label-size="sm"
          >
            <b-form-input
              size="sm"
              id="actor-beneficiario"
              v-model="beneficiario.actor"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="desc1-beneficiario"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Descripcion"
            label-for="desc-beneficiario"
            label-size="sm"
          >
            <b-form-textarea
              id="desc-beneficiario"
              v-model="beneficiario.descripcion"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
          <b-form-group
            id="comen-beneficiario"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentarios"
            label-for="comen-beneficiario"
            label-size="sm"
          >
            <b-form-textarea
              id="comen-beneficiario"
              v-model="beneficiario.comentarios"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
          <br /><br />
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                type="button"
                @click="handleOk(3)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                @click="hideModal('modal-beneficiario')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Responsabilidades-->
    <b-modal
      id="modal-respon"
      ref="modal-responsabilidades"
      title="Responsabilidades"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="responsabilidades" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group
            id="actorSoc-responsabilidades"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Stakeholder:"
            label-for="actorSoc-responsabilidades"
            label-size="sm"
            class="d-flex align-items-center"
          >
            <b-form-select
              id="actorSoc-responsabilidades"
              v-model="selPromResponsabilidad"
              :options="responsabilidades.actores"
              size="sm"
              class="mt-3"
            ></b-form-select>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="coment-responsabilidades"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentarios"
            label-for="comentarios-responsabilidades"
            label-size="sm"
          >
            <b-form-textarea
              id="comentarios-responsabilidades"
              v-model="responsabilidades.comentarios"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>

          <b-form-group
            id="activ-responsabilidad"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Responsabilidad:"
            label-for="responsable-responsabilidades"
            label-size="sm"
          >
            <b-form-input
              size="sm"
              id="responsable-responsabilidades"
              v-model="responsabilidades.responsable"
            ></b-form-input>
          </b-form-group>
          <button
            class="float-right btn btn-sm btn-success"
            @click="addResponsable()"
          >
            <i class="fa fa-plus"></i> Agregar
          </button>
          <table class="table table-striped table-sm mt-2">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Responsable</th>
                <th scope="col">---</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="itemc in responsabilidades.responsables"
                :key="itemc.id"
              >
                <td>{{ itemc.id }}</td>
                <td>{{ itemc.nombre }}</td>
                <td>
                  <button
                    class="btn btn-sm btn-danger"
                    @click="deleteResponsable(itemc.id)"
                  >
                    <i class="fa fa-minus-circle"></i>
                  </button>
                  <button
                    class="btn btn-sm btn-primary"
                    @click="editResponsable(itemc.id)"
                    style="background: #5e72e4; border-color: #5e72e4"
                  >
                    <i class="fa fa-pen-square text-white"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                type="button"
                @click="handleOk(4)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                type="button"
                @click="hideModal('modal-responsabilidades')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Recursos Sociales-->
    <b-modal
      id="modal-prevent-closing"
      ref="modal-recurso"
      title="Recursos Sociales"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="recurso" @submit.stop.prevent="handleSubmit">
        <b-form-group
          id="actorSoc-recursoSocial"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Stakeholder:"
          label-for="actorSoc-recursoSocial"
          label-size="sm"
          class="d-flex align-items-center"
        >
          <b-form-select
            id="actorSoc-recursoSocial"
            v-model="selRecursoSocial"
            :options="recurso.actorSocial"
            size="sm"
            class="mt-3"
          ></b-form-select>
        </b-form-group>
        <b-form-group
          id="colors-stiky-note"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Color stiky note:"
          label-for="colorStikyNote"
          label-size="sm"
          class="mr-1"
        >
          <b-form-radio-group id="colorStikyNote" class="d-flex">
            <!-- Radios in the default slot will appear after any option generated radios -->
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
            <b-form-radio class="input-radio"></b-form-radio>
          </b-form-radio-group>
        </b-form-group>
        <b-form-group
          id="coment-recursoSocial"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Comentarios"
          label-for="comentarios-recursoSocial"
          label-size="sm"
        >
          <b-form-textarea
            id="comentarios-recursoSocial"
            v-model="recurso.comentarios"
            placeholder="..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
        </b-form-group>
        <b-form-group
          id="activ-recursoSocial"
          label-cols-sm="4"
          label-cols-lg="3"
          content-cols-sm
          content-cols-lg="7"
          description=""
          label="Recurso:"
          label-for="recurso-recursoSocial"
          label-size="sm"
        >
          <b-form-input
            size="sm"
            id="recurso-recursoSocial"
            v-model="recurso.recursoSocial"
          ></b-form-input>
        </b-form-group>
        <button
          class="float-right btn btn-sm btn-success"
          @click="addRecurso()"
        >
          <i class="fa fa-plus"></i> Agregar
        </button>
        <table class="table table-striped table-sm mt-2">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Recurso</th>
              <th scope="col">---</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="itemc in recurso.recursoSocials" :key="itemc.id">
              <td>{{ itemc.id }}</td>
              <td>{{ itemc.nombre }}</td>
              <td>
                <button
                  class="btn btn-sm btn-danger"
                  @click="deleteRecurso(itemc.id)"
                >
                  <i class="fa fa-minus-circle"></i>
                </button>
                <button
                  class="btn btn-sm btn-primary"
                  @click="editRecurso(itemc.id)"
                  style="background: #5e72e4; border-color: #5e72e4"
                >
                  <i class="fa fa-pen-square text-white"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                @click="handleOk(5)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                @click="hideModal('modal-recurso')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Mecanismo de dialogo-->
    <b-modal
      id="modal-dialog"
      ref="modal-dialogo"
      title="Mecanismo de Dialogo"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="dialogo" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
              v-model="dialogo.selected"
              :options="dialogo.options"
              :aria-describedby="ariaDescribedby"
              name="flavour-2a"
              stacked
            ></b-form-checkbox-group>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="comen-dialogo"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentario"
            label-for="comentario-dialogo"
            label-size="sm"
          >
            <b-form-textarea
              id="comentario-dialogo"
              v-model="dialogo.comentario"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                @click="handleOk(6)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                @click="hideModal('modal-dialogo')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Gestion de la comunidad-->
    <b-modal
      id="modal-compro"
      ref="modal-compromiso"
      title="Gestión de la comunidad"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="compromiso" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
              v-model="compromiso.selected"
              :options="compromiso.options"
              :aria-describedby="ariaDescribedby"
              name="flavour-2a"
              stacked
            ></b-form-checkbox-group>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="comen-compromiso"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentario"
            label-for="comentario-compromiso"
            label-size="sm"
          >
            <b-form-textarea
              id="comentario-compromiso"
              v-model="compromiso.comentario"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                typye="button"
                @click="handleOk(7)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                typye="button"
                @click="hideModal('modal-compromiso')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!--Modal Beneficios-->
    <b-modal
      id="modal-social"
      ref="modal-rentabilidad"
      title="Rentabilidad Social"
      @show="resetModal"
      @hidden="resetModal"
    >
      <form ref="rentabilidad" @submit.stop.prevent="handleSubmit">
        <div class="container p-2">
          <b-form-group
            id="actorSoc-rentabilidad"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Stakeholder:"
            label-for="actorSoc-rentabilidad"
            label-size="sm"
            class="d-flex align-items-center"
          >
            <b-form-select
              id="actorSoc-rentabilidad"
              v-model="selRentabilidadAS"
              :options="rentabilidad.actorSocial"
              size="sm"
              class="mt-3"
            ></b-form-select>
          </b-form-group>
          <b-form-group
            id="colors-stiky-note"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Color stiky note:"
            label-for="colorStikyNote"
            label-size="sm"
            class="mr-1"
          >
            <b-form-radio-group id="colorStikyNote" class="d-flex">
              <!-- Radios in the default slot will appear after any option generated radios -->
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
              <b-form-radio class="input-radio"></b-form-radio>
            </b-form-radio-group>
          </b-form-group>
          <b-form-group
            id="activ-rentabilidad"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Beneficio:"
            label-for="beneficio-rentabilidad"
            label-size="sm"
          >
            <b-form-input
              size="sm"
              id="beneficio-rentabilidad"
              v-model="rentabilidad.beneficio"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="coment-rentabilidad"
            label-cols-sm="4"
            label-cols-lg="3"
            content-cols-sm
            content-cols-lg="7"
            description=""
            label="Comentarios"
            label-for="comentarios-rentabilidad"
            label-size="sm"
          >
            <b-form-textarea
              id="comentarios-rentabilidad"
              v-model="rentabilidad.comentarios"
              placeholder="..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
        </div>
      </form>
      <template #modal-footer>
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button
                class="float-left btn btn-sm btn-primary"
                type="button"
                @click="handleOk(8)"
              >
                <i class="fa fa-save"></i> Guardar
              </button>
            </div>
            <div class="col text-rigth">
              <button
                class="float-right btn btn-sm btn-danger"
                type="button"
                @click="hideModal('modal-rentabilidad')"
              >
                <i class="fa fa-times"></i> Cerrar
              </button>
            </div>
          </div>
        </div>
      </template>
    </b-modal>

    <!-- SECCION DE MATRIZ -->
    <div class="container mt-4 px-0">
      <MatrixStakeholders
        :key="keyMatrix"
        :stakeHolders="project.promotores"
        :beneficiaries="project.beneficiarios"
        v-model="matrixData"
      />
    </div>
  </div>
</template>

<script>
import ThreeStateCheckbox from "./../../../js/components/Checkbox/ThreeStateCheckbox.vue";
import MatrixStakeholders from "../../../js/components/Matrix/MatrixStakeholders.vue";
import { dataInitMatrix } from "../Matrix/defaultData";
import Vue from "vue";
import Swal from "sweetalert2";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { Input, Tooltip, Popover } from "element-ui";
import {
  BModal,
  VBModal,
  BFormInput,
  BFormGroup,
  BFormRadio,
  BFormRadioGroup,
  BFormFile,
  BFormSelect,
  BFormTextarea,
} from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import { GridLayout, GridItem } from "vue-grid-layout";
import { Form } from "vform";
import VueRouter from 'vue-router'

const defaultProyecto = {
  nombre: "",
  objetivo: "",
  color: "",
  componente: "",
  componentes: [],
  monto: 0.0,
  descripcion: "",
  coordenadas: "",
  ubigeo: "",
  // attachment: "null",
};

const defaultPromotor = {
  actorSocial: "",
  color: "",
  descripcion: "",
  comentarios: "",
};

const defaultBeneficiario = {
  actor: "",
  comunidad: "",
  descripcion: "",
  comentarios: "",
  color: "",
  impactos: [
    {
      value: null,

      text: "Seleccione",
    },
    {
      value: "a",
      text: "Tipo A",
    },
    {
      value: "b",
      text: "Tipo B",
    },
  ],
};

const defaultResponsabilidad = {
  actores: [
    {
      value: null,
      text: "Seleccione",
    },
    {
      value: "Tipo a",
      text: "Tipo A",
    },
    {
      value: "Tipo B",
      text: "Tipo B",
    },
  ],
  color: "",
  comentarios: "",
  responsable: "",
  responsables: [],
};

const defaultRecursoSocial = {
  recursoSocial: "",
  recursoSocials: [],
  nombreActor: "",
  comentarios: "",
  actorSocial: [
    {
      value: null,
      text: "Seleccione",
    },
    {
      value: "Actor A",
      text: "Actor A",
    },
    {
      value: "Actor B",
      text: "Actor B",
    },
  ],
};

const defaultMecanismoDialogo = {
  selected: [],
  comentario: "",
  options: [
    {
      text: "Sin dialogo",
      value: "Sin dialogo",
    },
    {
      text: "Logistica (Mecanismo de reclamos EIA, etc.)",
      value: "Logistica (Mecanismo de reclamos EIA, etc.)",
    },
    {
      text: "Mesa de Dialogo",
      value: "Mesa de Dialogo",
    },
    {
      text: "Mesa de desarrollo",
      value: "Mesa de desarrollo",
    },
    {
      text: "Mesa Ejecutiva Territorial",
      value: "Mesa Ejecutiva Territorial",
    },
  ],
};

const defaultGestionComunidad = {
  selected: [],
  comentario: "",
  options: [
    {
      text: "Sin gestión hacia la comunidad",
      value: "Sin gestión hacia la comunidad",
    },
    {
      text: "La empresa gestiona todo",
      value: "La empresa gestiona todo",
    },
    {
      text: "Co-gestión (Empresa-Comunidad)",
      value: "Co-gestión (Empresa-Comunidad)",
    },
    {
      text: "Gestión de la comunidad",
      value: "Gestión de la comunidad",
    },
  ],
};

const defaultBeneficios = {
  actorSocial: [
    {
      value: null,
      text: "Seleccione",
    },
    {
      value: "Tipo A",
      text: "Tipo A",
    },
  ],
  beneficio: "",
  comentarios: "",
};

let mouseXY = { x: null, y: null };
let DragPos = { x: null, y: null, w: 1, h: 1, i: null };

export default {
  components: {
    GridLayout,
    GridItem,
    ThreeStateCheckbox,
    MatrixStakeholders,
    Form,
    Input,
    Tooltip,
    Vue,
    Popover,
    BModal,
    VBModal,
    BFormInput,
    BFormGroup,
    BFormRadio,
    BFormRadioGroup,
    BFormFile,
    BFormSelect,
    BFormTextarea,
    Swal,
    BootstrapVue,
    IconsPlugin,
    VueRouter
  },
  props: ["data"],
  directives: {
    "b-popover": Popover,
    "b-modal": VBModal,
    "b-form-input": BFormInput,
    "b-form-group": BFormGroup,
    "b-form-radio": BFormRadio,
    "b-form-radio-group": BFormRadioGroup,
    "b-form-file": BFormFile,
    "b-form-select": BFormSelect,
    "b-form-textarea": BFormTextarea,
  },
  data() {
    return {
      visibleFormCrud: false,
      showStyle1: true,
      estilo1:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 50px;",
      estilo2:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 40px;",
      estilo3:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 50px;",
      estilo4:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 50px;",
      estilo5:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 50px;",
      estilo6:
        "width: 15px; height: 15px; margin-top: -20px;margin-left: 50px;",
      contentActual: "content",
      layout: [],
      layout2: [],
      layout3: [],
      layout4: [],
      layout5: [],
      layout6: [],
      layout7: [],
      layout8: [],
      popOver: [
        "Proyecto: Es el proyecto de la empresa que impactara a los diversos grupos de interes.",
        "Promotores: Se refiere a los promotores del proyecto",
        "Beneficiarios: Se refiere a los recursos o activos(dinero, propiedades, horas hombre, tiempo, etc)",
        "Responsabilidades: Se refiere a las responsbilidades que asumen cada promotor y/o beneficiario para diseñar e implementar el proyecto",
        "Recursos Sociales: Se refiere a los recursos o activos (dinero, propiedades, horas hombre, tiempo, etc.) que cada promotor y/o beneficiario ponen para realizar el proyecto",
        "Mecanismo de diálogo: Se refiere al mecanimos de diálogo para discutir y llegar a acuerdos respecto al diseño y la implementación del proyecto",
        "Gestión de la comunidad: Se refiere al empoderamiento de los beneficiarios en el diseño y la gestión del proyecto.",
        "Beneficios: Se refiere a los beneficios que genera el proyecto tanto a los promotores como a los beneficiarios",
      ],
      listWidth: 0,
      listHeight: 0,
      width: 0,
      height: 0,
      top: 0,
      left: 0,
      draggable: true,
      resizable: true,
      responsive: false,
      index: 0,

      list1: [],
      list2: [],
      list3: [],
      list4: [],
      list5: [],
      list6: [],
      list7: [],
      list8: [],
      //Area Modals--------------
      //Proyecto
      proyecto: new Form({
        nombre: "",
        objetivo: "",
        componente: "",
        componentes: [],
        monto: 0.0,
        descripcion: "",
        coordenadas: "",
      }),
      project: {
        promotores: [],
        beneficiarios: [],
      },
      matrixData: JSON.parse(JSON.stringify(dataInitMatrix)),
      keyMatrix: 6565656565,
      attachment: null,
      //promotor
      selTipoPromotor: null,
      selTipoColor: null,
      selImpacProm: null,
      promotor: new Form({
        tipo: [
          {
            value: null,
            text: "Seleccione",
          },
          {
            value: "a",
            text: "PRINCIPAL",
          },
          {
            value: "b",
            text: "SECUNDARIO",
          },
        ],
        actorSocial: "",
        descripcion: "",
        comentarios: "",
        impactos: [
          {
            text: "Opcion 1",
            value: "op1",
          },
          {
            text: "Opcion 2",
            value: "op2",
          },
          {
            text: "Opcion 3",
            value: "op3",
          },
          {
            text: "Opcion 4",
            value: "op4",
          },
        ],
      }),
      //beneficiario
      selTipoImpacBenef: null,
      beneficiario: new Form({
        actor: "",
        comunidad: "",
        descripcion: "",
        comentarios: "",
        impactos: [
          {
            value: null,
            text: "Seleccione",
          },
          {
            value: "a",
            text: "Tipo A",
          },
          {
            value: "b",
            text: "Tipo B",
          },
        ],
      }),
      //responsabilidad
      selPromResponsabilidad: null,
      selBenefResponsabilidad: null,
      responsabilidades: new Form({
        actores: [
          {
            value: null,
            text: "Seleccione",
          },
          {
            value: "Tipo a",
            text: "Tipo A",
          },
          {
            value: "Tipo B",
            text: "Tipo B",
          },
        ],
        responsable: "",
        responsables: [],
        comentarios: "",
      }),
      //recurso Social
      selRecursoSocial: null,
      recurso: new Form({
        recursoSocial: "",
        recursoSocials: [],
        nombreActor: "",
        comentarios: "",
        actorSocial: [
          {
            value: null,
            text: "Seleccione",
          },
          {
            value: "Actor A",
            text: "Actor A",
          },
          {
            value: "Actor B",
            text: "Actor B",
          },
        ],
      }),
      //dialogo
      dialogo: new Form({
        selected: [],
        comentario: "",
        options: [
          {
            text: "Sin dialogo",
            value: "Sin dialogo",
          },
          {
            text: "Logistica (Mecanismo de reclamos EIA, etc.)",
            value: "Logistica (Mecanismo de reclamos EIA, etc.)",
          },
          {
            text: "Mesa de Dialogo",
            value: "Mesa de Dialogo",
          },
          {
            text: "Mesa de desarrollo",
            value: "Mesa de desarrollo",
          },
          {
            text: "Mesa Ejecutiva Territorial",
            value: "Mesa Ejecutiva Territorial",
          },
        ],
      }),
      //compromiso
      compromiso: new Form({
        selected: [],
        comentario: "",
        options: [
          {
            text: "Sin gestión hacia la comunidad",
            value: "Sin gestión hacia la comunidad",
          },
          {
            text: "La empresa gestiona todo",
            value: "La empresa gestiona todo",
          },
          {
            text: "Co-gestión (Empresa-Comunidad)",
            value: "Co-gestión (Empresa-Comunidad)",
          },
          { text: "Gestión de la comunidad", value: "Gestión de la comunidad" },
        ],
      }),
      //Rentabilidad
      selRentabilidadAS: null,
      rentabilidad: new Form({
        beneficio: "",
        comentarios: "",
        actorSocial: [{ value: null, text: "Seleccione" }],
      }),
      //------------------
      cardActual: 0,
      name: "",
      nameState: null,
      submittedNames: [],
      editmode: false,
      perPage: 10,
      currentPage: 1,
      totalItemsRow: 10,
      //------------------
      stickyFloating: [],
      checkboxValue: null,
    };
  },
  methods: {
    touch(e) {
      this.stickyFloating.push({ value: "" });
    },
    deleteStickyFloating(e) {
      this.stickyFloating.splice(e, 1);
    },
    removeDialog(dialog) {
      let id = dialog.id;
      let index = this.findDialog(id);
      this.dialogs.splice(index, 1);
      if (this.selected && this.selected.id === id) this.selected = null;
    },
    //-------------CRUD COMPONENTE-----------------
    addComponente() {
      if (this.proyecto.componente != "") {
        this.proyecto.componentes.push({
          id: this.proyecto.componentes.length + 1,
          nombre: this.proyecto.componente,
        });
        this.proyecto.componente = "";
      } else {
        this.$swal("", "Debe agregar un nombre de componente", "error");
      }
    },
    deleteComponente(val) {
      const index = this.proyecto.componentes
        .map((item) => item.id)
        .indexOf(val);
      this.proyecto.componentes.splice(index, 1);
    },
    editComponente(val) {
      this.editmode = true;
      this.form.componente = val.name.split("")[0];
    },
    //-------------CRUD RESPONSABLE-----------------
    addResponsable() {
      if (this.responsabilidades.responsable != "") {
        this.responsabilidades.responsables.push({
          id: this.responsabilidades.length + 1,
          nombre: this.responsabilidades.responsable,
        });
        this.responsabilidades.responsable = "";
      } else {
        this.$swal("", "Debe agregar el nombre del responsable", "error");
      }
    },
    deleteResponsable(val) {
      const index = this.responsabilidades.responsables
        .map((item) => item.id)
        .indexOf(val);
      this.responsabilidades.responsables.splice(index, 1);
    },
    editResponsable(val) {
      this.editmode = true;
      this.form.responsable = val.name.split("")[0];
    },
    //-------------CRUD RECURSO SOCIAL-----------------
    addRecurso() {
      if (this.recurso.recursoSocial != "") {
        this.recurso.recursoSocials.push({
          id: this.recurso.recursoSocials.length + 1,
          nombre: this.recurso.recursoSocial,
        });
        this.recurso.recursoSocial = "";
      } else {
        this.$swal("", "Debe agregar un nombre de componente", "error");
      }
    },
    deleteRecurso(val) {
      const index = this.recurso.recursoSocials
        .map((item) => item.id)
        .indexOf(val);
      this.recurso.recursoSocials.splice(index, 1);
    },
    editRecurso(val) {
      this.editmode = true;
      this.form.recursoSocial = val.name.split("")[0];
    },
    //--  Comp Comunidad
    //------------------------------
    addCard: function (key) {
      this.editmode = false;
      this.cardActual = key;
      this.name = "TEST" + key.toString();

      switch (key) {
        case 1:
          this.showModal("modal-proyecto");
          break;
        case 2:
          this.showModal("modal-promotor");
          break;
        case 3:
          this.showModal("modal-beneficiario");
          break;
        case 4:
          this.showModal("modal-responsabilidades");
          break;
        case 5:
          this.showModal("modal-recurso");
          break;
        case 6:
          this.showModal("modal-dialogo");
          break;
        case 7:
          this.showModal("modal-compromiso");
          break;
        case 8:
          this.showModal("modal-rentabilidad");
          break;
        default:
          this.showModal("modal-herr");
          break;
      }
    },
    addStickyNoteProyecto: function (key) {
      const keys = {
        "modal-proyectos": () => {
          const index = this.layout.length;
          if (index == 0) {
            this.layout.push({
              x: 0,
              y: 0,
              w: 2,
              h: 3.5,
              i: index,
              data: {
                Nombre: "proyecto " + index + 1,
                Proyecto: new Form(JSON.parse(JSON.stringify(defaultProyecto))),
              },
            });
          }
          this.proyecto = this.layout[index].data.Proyecto;
          this.showModal("modal-proyecto");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNotePromotor: function (key) {
      const keys = {
        "modal-promotores": () => {
          const index = this.layout2.length;
          this.layout2.push({
            x: 0,
            y: 0,
            w: 5,
            h: 3,
            i: index,
            data: {
              Nombre: "promotor " + index + 1,
              Promotor: new Form(JSON.parse(JSON.stringify(defaultPromotor))),
            },
          });
          this.promotor = this.layout2[index].data.Promotor;
          this.showModal("modal-promotor");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteBeneficiario: function (key) {
      const keys = {
        "modal-beneficiarios": () => {
          const index = this.layout3.length;
          this.layout3.push({
            x: 0,
            y: 0,
            w: 5,
            h: 3,
            i: index,
            data: {
              Nombre: "beneficiario " + index + 1,
              Beneficiario: new Form(
                JSON.parse(JSON.stringify(defaultBeneficiario))
              ),
            },
          });
          this.beneficiario = this.layout3[index].data.Beneficiario;
          this.showModal("modal-beneficiario");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteResponsabilidad: function (key) {
      const keys = {
        "modal-responsabilidades": () => {
          const index = this.layout4.length;
          this.layout4.push({
            x: 0,
            y: 0,
            w: 2.5,
            h: 3,
            i: index,
            data: {
              Nombre: "responsabilidad " + index + 1,
              Responsabilidad: new Form(
                JSON.parse(JSON.stringify(defaultResponsabilidad))
              ),
            },
          });
          this.responsabilidades = this.layout4[index].data.Responsabilidad;
          this.showModal("modal-responsabilidades");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteRecursoSocial: function (key) {
      const keys = {
        "modal-recursos": () => {
          const index = this.layout5.length;
          this.layout5.push({
            x: 0,
            y: 0,
            w: 2.5,
            h: 3,
            i: index,
            data: {
              Nombre: "recur. sociales " + index + 1,
              Recurso: new Form(
                JSON.parse(JSON.stringify(defaultRecursoSocial))
              ),
            },
          });
          this.recurso = this.layout5[index].data.Recurso;
          this.showModal("modal-recurso");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteMecanismoDialogo: function (key) {
      const keys = {
        "modal-dialogos": () => {
          const index = this.layout6.length;
          this.layout6.push({
            x: 0,
            y: 0,
            w: 2.5,
            h: 3,
            i: index,
            data: {
              Nombre: "mecan. dialogo " + index + 1,
              Dialogo: new Form(
                JSON.parse(JSON.stringify(defaultMecanismoDialogo))
              ),
            },
          });
          this.dialogo = this.layout6[index].data.Dialogo;
          this.showModal("modal-dialogo");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteGestionComunidad: function (key) {
      const keys = {
        "modal-gestiones": () => {
          const index = this.layout7.length;
          this.layout7.push({
            x: 0,
            y: 0,
            w: 4,
            h: 3,
            i: index,
            data: {
              Nombre: "Gestion de la comunidad " + index + 1,
              Compromiso: new Form(
                JSON.parse(JSON.stringify(defaultGestionComunidad))
              ),
            },
          });
          this.compromiso = this.layout7[index].data.Compromiso;
          this.showModal("modal-compromiso");
        },
      };
      keys[key] && keys[key]();
    },
    addStickyNoteBeneficio: function (key) {
      const keys = {
        "modal-beneficios": () => {
          const index = this.layout8.length;
          this.layout8.push({
            x: 0,
            y: 0,
            w: 3,
            h: 3,
            i: index,
            data: {
              Nombre: "Beneficios " + index + 1,
              Rentabilidad: new Form(
                JSON.parse(JSON.stringify(defaultBeneficios))
              ),
            },
          });
          this.rentabilidad = this.layout8[index].data.Rentabilidad;
          this.showModal("modal-rentabilidad");
        },
      };
      keys[key] && keys[key]();
    },
    async updateProyecto(formProyecto) {
      if (this.$route.query.hasOwnProperty("id")) {
        const proyectoId = this.$route.query.id;

        formProyecto
          .put("/admin/proyectos/update/" + proyectoId)
          .then(() => {
            this.hideModal("modal-proyecto");
            this.$swal.fire(
              "Actualizado!",
              "Actualizado Correctamente!.",
              "success"
            );
          })
          .catch((e) => {});
      }
    },
    async saveComponente(form, url, modal) {
      if (this.$route.query.hasOwnProperty("id")) {
        const proyectoId = this.$route.query.id;
        console.log("tipo", form, modal);
        form.proyectoId = proyectoId;
        if (url === "responsabilidades") {
          form.actorSocial = this.selPromResponsabilidad;
        }

        if (url === "recursos") {
          form.nombreActor = this.selRecursoSocial;
        }

        if (url === "rentabilidad") {
          form.actorSocial = this.selRentabilidadAS;
        }
        await form
          .post(this.$gate.getApiUrl() + "proyectos/" + url)
          .then(() => {
            this.hideModal(modal);
            this.$swal(
              "Actualizado!",
              "Actualizado Correctamente!.",
              "success"
            );

            // Save info in local
            const formData = { ...form };
            delete formData.errors;
            delete formData.originalData;
            delete formData.busy;
            if (modal == "modal-promotor") {
              this.project.promotores.push(
                JSON.parse(JSON.stringify(formData))
              );
            }
            if (modal == "modal-beneficiario") {
              this.project.beneficiarios.push(
                JSON.parse(JSON.stringify(formData))
              );
            }

            this.keyMatrix += 20;
          })
          .catch((e) => {
            if (e.response.status == 401) {
              this.$gate.removeLogin();
              this.$router.push("/Login");
            }
          });
      }
    },
    //------------------------------------------
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOk(key, formActual, bvModalEvent) {
      switch (key) {
        case 1:
          this.updateProyecto(this.proyecto);
          break;

        case 2:
          this.list2.push({
            name: "PROMOTOR -" + this.name,
            id: this.list2.length + 1,
          });
          this.responsabilidades.actores.push({
            value: this.promotor.actorSocial,
            text: this.promotor.actorSocial + " - (Promotor)",
          });
          this.recurso.actorSocial.push({
            value: this.promotor.actorSocial,
            text: this.promotor.actorSocial + " - (Promotor)",
          });

          this.saveComponente(this.promotor, "promotor", "modal-promotor");
          console.log({ promotores: this.list2, promotor });

          break;
        case 3:
          this.list3.push({
            name: "BENEFICIARIO -" + this.name,
            id: this.list3.length + 1,
          });
          this.recurso.actorSocial.push({
            value: this.beneficiario.actor,
            text: this.beneficiario.actor + " - (Intervenidos)",
          });
          this.responsabilidades.actores.push({
            value: this.beneficiario.actor,
            text: this.beneficiario.actor + " - (Intervenidos)",
          });
          this.rentabilidad.actorSocial.push({
            value: this.beneficiario.actor,
            text: this.beneficiario.actor + " - (Intervenidos)",
          });
          this.saveComponente(
            this.beneficiario,
            "beneficiario",
            "modal-beneficiario"
          );
          console.log({ beneficiarios: this.list3 });
          break;
        case 4:
          this.list4.push({
            name: "RESPONSABILIDAD -" + this.name,
            id: this.list4.length + 1,
          });
          this.saveComponente(
            this.responsabilidades,
            "responsabilidades",
            "modal-responsabilidades"
          );
          break;
        case 5:
          this.list5.push({
            name: "RECURSOS -" + this.name,
            id: this.list5.length + 1,
          });
          this.saveComponente(this.recurso, "recursos", "modal-recurso");
          break;
        case 6:
          this.list6.push({
            name: "DIALOGO -" + this.name,
            id: this.list6.length + 1,
          });
          this.saveComponente(this.dialogo, "dialogo", "modal-dialogo");
          break;
        case 7:
          this.list7.push({
            name: "COMUNIDAD -" + this.name,
            id: this.list7.length + 1,
          });
          this.saveComponente(
            this.compromiso,
            "compromiso",
            "modal-compromiso"
          );
          break;
        case 8:
          this.list8.push({
            name:
              "RESPONSABILIDAD SOCIAL -" + this.name + this.list8.length + 1,
            id: this.list8.length + 1,
          });
          this.saveComponente(
            this.rentabilidad,
            "rentabilidad",
            "modal-rentabilidad"
          );
          break;

        default:
          break;
      }
    },
    handleSubmit() {
      if (!this.checkFormValidity()) {
        return;
      }
      this.$nextTick(() => {
        this.$bvModal.hide("modal-herr");
      });
    },
    //------------------------------------------
    showModal(modal, id) {
      this.$refs[modal].show();
    },
    hideModal(modal) {
      this.$refs[modal].hide();
    },
    editModal(modal, item) {
      this.editmode = true;
      this.name = item.name;
      const keys = {
        "modal-promotor": () => {
          this.promotor = new Form(item.data.Promotor);
        },
      };
      keys[modal] && keys[modal]();
      this.$refs[modal].show();
    },
    aplicarFiltro() {
      let loader = this.$loading.show({
        container: this.fullPage ? null : this.$refs.formContainer,
        canCancel: true,
        loader: "dots",
      });

      loader.hide();
    },
    resetFiltro() {
      this.filtro.reset();
      this.filtroActivo = false;
    },
    onFiltroChange() {
      this.filtroActivo = true;
    },
    removeItem: function (val, i) {
      let actualLayout = null;
      Swal.fire({
        title: "Esta Seguro de Eliminar?",
        text: "No podra revertir los cambios!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Procedo a Borrar!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          switch (i) {
            case 1:
              actualLayout = this.layout;
              break;
            case 2:
              actualLayout = this.layout2;
              this.keyMatrix += 20;
              break;
            case 3:
              actualLayout = this.layout3;
              this.keyMatrix += 20;
              break;
            case 4:
              actualLayout = this.layout4;
              break;
            case 5:
              actualLayout = this.layout5;
              break;
            case 6:
              actualLayout = this.layout6;
              break;
            case 7:
              actualLayout = this.layout7;
              break;
            case 8:
              actualLayout = this.layout8;
              break;
          }

          const index = actualLayout.map((item) => item.i).indexOf(val);
          actualLayout.splice(index, 1);
        }
      });
    },
    //Begin metod Drag
    drag: function (e) {
      let parentRect = document
        .getElementById("content")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout.findIndex((item) => item.i === "drop") === -1
      ) {
        if (this.layout.length == 0)
          this.layout.push({
            x: (this.layout.length * 2) % (this.colNum || 12),
            y: this.layout.length + (this.colNum || 12), // puts it at the bottom
            w: 1,
            h: 1,
            i: "drop",
            data: { Nombre: "proyecto " + DragPos.i, Proyecto: this.proyecto },
          });
      }
      let index = this.layout.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout.$children[
            this.layout.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout[index].x;
          DragPos.y = this.layout[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout = this.layout.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //---------2--------
    drag2: function (e) {
      let parentRect = document
        .getElementById("content2")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout2.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout2.push({
          x: (this.layout2.length * 2) % (this.colNum || 12),
          y: this.layout2.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "promotor " + parseInt(DragPos.i) + 1,
            Promotor: this.promotor,
          },
        });
      }
      let index = this.layout2.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout2.$children[
            this.layout2.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout2.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout2.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout2[index].x;
          DragPos.y = this.layout2[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout2.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout2 = this.layout2.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag3: function (e) {
      let parentRect = document
        .getElementById("content3")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout3.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout3.push({
          x: (this.layout3.length * 2) % (this.colNum || 12),
          y: this.layout3.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "beneficiario " + parseInt(DragPos.i) + 1,
            Beneficiario: this.beneficiario,
          },
        });
      }
      let index = this.layout3.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout3.$children[
            this.layout3.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout3.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout3.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout3[index].x;
          DragPos.y = this.layout3[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout3.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout3 = this.layout3.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag4: function (e) {
      let parentRect = document
        .getElementById("content4")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout4.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout4.push({
          x: (this.layout4.length * 2) % (this.colNum || 12),
          y: this.layout4.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "responsabilidad " + parseInt(DragPos.i) + 1,
            Responsabilidad: this.responsabilidades,
          },
        });
      }
      let index = this.layout4.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout4.$children[
            this.layout4.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout4.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout4.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout4[index].x;
          DragPos.y = this.layout4[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout4.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout4 = this.layout4.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag5: function (e) {
      let parentRect = document
        .getElementById("content5")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout5.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout5.push({
          x: (this.layout5.length * 2) % (this.colNum || 12),
          y: this.layout5.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "Recurso " + parseInt(DragPos.i) + 1,
            Recurso: this.recurso,
          },
        });
      }
      let index = this.layout5.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout5.$children[
            this.layout5.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout5.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout5.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout5[index].x;
          DragPos.y = this.layout5[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout5.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout5 = this.layout5.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag6: function (e) {
      let parentRect = document
        .getElementById("content6")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout6.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout6.push({
          x: (this.layout6.length * 2) % (this.colNum || 12),
          y: this.layout6.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "mecan. dialogo " + parseInt(DragPos.i + 1),
            Dialogo: this.dialogo,
          },
        });
      }
      let index = this.layout6.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout6.$children[
            this.layout6.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout6.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout6.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout6[index].x;
          DragPos.y = this.layout6[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout6.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout6 = this.layout6.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag7: function (e) {
      let parentRect = document
        .getElementById("content7")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout7.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout7.push({
          x: (this.layout7.length * 2) % (this.colNum || 12),
          y: this.layout7.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "compromiso con la comunidad " + parseInt(DragPos.i) + 1,
            Compromiso: this.compromiso,
          },
        });
      }
      let index = this.layout7.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout7.$children[
            this.layout7.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout7.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout7.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout7[index].x;
          DragPos.y = this.layout7[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout7.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout7 = this.layout7.filter((obj) => obj.i !== "drop");
        }
      }
    },
    //-----------------
    drag8: function (e) {
      let parentRect = document
        .getElementById("content8")
        .getBoundingClientRect();
      let mouseInGrid = false;
      if (
        mouseXY.x > parentRect.left &&
        mouseXY.x < parentRect.right &&
        mouseXY.y > parentRect.top &&
        mouseXY.y < parentRect.bottom
      ) {
        mouseInGrid = true;
      }
      if (
        mouseInGrid === true &&
        this.layout8.findIndex((item) => item.i === "drop") === -1
      ) {
        this.layout8.push({
          x: (this.layout8.length * 2) % (this.colNum || 12),
          y: this.layout8.length + (this.colNum || 12), // puts it at the bottom
          w: 1,
          h: 1,
          i: "drop",
          data: {
            Nombre: "Beneficios " + parseInt(DragPos.i) + 1,
            Rentabilidad: this.rentabilidad,
          },
        });
      }
      let index = this.layout8.findIndex((item) => item.i === "drop");
      if (index !== -1) {
        try {
          this.$refs.gridlayout8.$children[
            this.layout8.length
          ].$refs.item.style.display = "none";
        } catch {}
        let el = this.$refs.gridlayout8.$children[index];
        el.dragging = {
          top: mouseXY.y - parentRect.top,
          left: mouseXY.x - parentRect.left,
        };
        let new_pos = el.calcXY(
          mouseXY.y - parentRect.top,
          mouseXY.x - parentRect.left
        );
        if (mouseInGrid === true) {
          try {
            this.$refs.gridlayout8.dragEvent(
              "dragstart",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          DragPos.i = String(index);
          DragPos.x = this.layout8[index].x;
          DragPos.y = this.layout8[index].y;
        }
        if (mouseInGrid === false) {
          try {
            this.$refs.gridlayout8.dragEvent(
              "dragend",
              "drop",
              new_pos.x,
              new_pos.y,
              1,
              1
            );
          } catch {}
          this.layout8 = this.layout8.filter((obj) => obj.i !== "drop");
        }
      }
    },
    async loadProyecto() {
      if (this.$route.query.hasOwnProperty("id")) {
        const proyectoId = this.$route.query.id;
        await axios
          .get(this.$gate.getApiUrl() + "proyectos/" + proyectoId)
          .then(({ data }) => {
            //console.log(data.proyecto.pj);
            this.proyecto.fill(data.proyecto.pj);
            this.promotor.fill(data.promotor.prj);
            this.beneficiario.fill(data.beneficiario.bj);
            this.responsabilidades.fill(data.responsabilidades.rj);
            data.recurso.rej.actorSocial.push(
              {
                value: data.beneficiario.bj.actor,
                text: data.beneficiario.bj.actor,
              },
              {
                value: data.promotor.prj.actorSocial,
                text: data.promotor.prj.actorSocial,
              }
            );
            this.recurso.fill(data.recurso.rej);
            this.dialogo.fill(data.dialogo.dj);
            this.compromiso.fill(data.compromiso.cj);

            this.selRentabilidadAS = data.rentabilidad.rtj.actorSocial;
            let oRenta = {
              actorSocial: [
                {
                  value: data.beneficiario.bj.actor,
                  text: data.beneficiario.bj.actor,
                },
                {
                  value: data.promotor.prj.actorSocial,
                  text: data.promotor.prj.actorSocial,
                },
              ],
              beneficio: data.rentabilidad.rtj.beneficio,
              comentarios: data.rentabilidad.rtj.comentarios,
              proyectoId: data.rentabilidad.rtj.proyectoId,
            };
            this.rentabilidad.fill(oRenta);
          })
          .catch((e) => {
            //console.log(e);
            /* si el token es invalido o esta vencido */
            if (e.response.status == 401) {
              this.$gate.removeLogin();
              this.$router.push("/Login");
            }
          });
      } else {
        this.swal(
          "",
          "Falta el Parametro [Id] para cargar un proyecto",
          "error"
        );
        this.$router.push("/proyectos");
      }
    },
  },
  created() {
    this.loadProyecto();
    Fire.$on("AfterCreate", () => {
      this.loadProyecto();
    });
  },
  watch: {},
  mounted() {
    console.log("aqui: ", this)
    this.$root.$on("estilo1", () => {
      this.showStyle1 = true;
    });
    this.$root.$on("estilo2", () => {
      this.showStyle1 = false;
    });

    document.addEventListener(
      "dragover",
      function (e) {
        mouseXY.x = e.clientX;
        mouseXY.y = e.clientY;
      },
      false
    );
  },
};
</script>
<style src="vue-dialog-drag/dist/vue-dialog-drag.css"></style>

<!-- optional dialog styles, see example -->
<style src="vue-dialog-drag/dist/dialog-styles.css"></style>
<style scoped>
h3 {
  font-size: 1.0625rem !important;
}
.card-body {
  padding: 1.25rem !important;
}

.clamp {
  width: clamp(6rem, 20vw, 10rem) !important;
}
.clamp-sm {
  width: clamp(10rem, 20vw, 16rem) !important;
}
.clamp-md {
  width: clamp(10rem, 20vw, 21rem) !important;
}
.clamp-lg {
  width: clamp(15rem, 24vw, 21rem) !important;
}
.clamp-xl {
  width: clamp(20rem, 30vw, 42rem) !important;
}
.tb td,
.tb th {
  white-space: pre-line;
}
.stiky-note-floating,
#create {
  width: 200px;
  height: 150px;
}
#create {
  user-select: none;
  padding: 20px;
  border-radius: 20px;
  text-align: center;
  border: 15px solid rgba(0, 0, 0, 0.1);
  cursor: pointer;
  color: rgba(0, 0, 0, 0.1);
  font-size: 150px;
  line-height: 185px;
}

#create:hover {
  border-color: rgba(0, 0, 0, 0.2);
  color: rgba(0, 0, 0, 0.2);
}
.stiky-note-floating {
  line-height: 1.5;
  border: 0;
  border-radius: 3px;
  background: linear-gradient(#f9efaf, #f7e98d);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transition: box-shadow 0.5s ease;
  width: min(200px, 550px);
  height: min(10rem, 25rem);
  overflow-y: auto;
}
.stiky-note-floating:hover {
  box-shadow: 0 5px 8px rgba(0, 0, 0, 0.15);
}
.stiky-note-floating:focus {
  box-shadow: 0 5px 12px rgba(0, 0, 0, 0.2);
  outline: none;
}
.btnStaticShow {
  float: left;
  /* para mantener visible un elemento en todo momento aunque se haga scroll en la página */
  position: fixed;
  overflow: hidden;
  text-align: center;
  width: 5%;
  padding: 4px;
}
.btnStaticHiden {
  float: left;
  /* para mantener visible un elemento en todo momento aunque se haga scroll en la página */
  position: fixed;
  overflow: hidden;
  text-align: center;
  width: 85px;
  padding: 4px;
}
.remove {
  color: black;
  font-weight: 700;
  position: absolute;
  right: 2px;
  top: 0;
  cursor: pointer;
}

.textb {
  font-weight: 700;
  text-transform: uppercase;
  color: black !important;
}
/** */
.vue-grid-layout {
  background: #eee;
}
.vue-grid-item:not(.vue-grid-placeholder) {
  background: #ccc;
  border: 1px solid black;
}
.vue-grid-item .resizing {
  opacity: 0.9;
}
.vue-grid-item .static {
  background: #feff9c;
}
.vue-grid-item .text {
  font-size: 12px;
  text-align: center;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
  height: 100%;
  width: 100%;
  color: black;
}
/* .list-group-itemm {
  position: relative !important;
  display: block !important;
  padding-top: 6px !important;
  padding-right: 23px !important;
  padding-bottom: 5px !important;
  padding-left: 23px !important;
  background-color: #fff !important;
  border: 1px solid #e9ecef !important;
} */
.vue-grid-item .no-drag {
  height: 100%;
  width: 100%;
}
.vue-grid-item .minMax {
  font-size: 12px;
}
.vue-grid-item .add {
  cursor: pointer;
}
.vue-draggable-handle {
  position: absolute;
  width: 20px;
  height: 20px;
  top: 0;
  left: 0;
  background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>")
    no-repeat;
  background-position: bottom right;
  padding: 0 8px 8px 0;
  background-repeat: no-repeat;
  background-origin: content-box;
  box-sizing: border-box;
  cursor: pointer;
}
.layoutJSON {
  background: #ddd;
  border: 1px solid black;
  margin-top: 10px;
  padding: 10px;
}
.columns {
  -moz-columns: 120px;
  -webkit-columns: 120px;
  columns: 120px;
}

.filler {
  width: 100%;
  height: 100%;
  display: inline-block;
  position: absolute;
}

.hands {
  cursor: pointer;
}
.headt td {
  min-width: 235px;
  height: 100px;
}

.bordes {
  border-radius: 15px;
}
.cellbackgr {
  background: #c0c0c0;
}
.statscard {
  font-size: 13px;
}
.fondotasa {
  background: #f5f5f5;
  font-weight: bold;
}
.detallefactura {
  font-size: 0.8125rem;
  white-space: nowrap;
}
.bckgmontobs {
  background: #e2e6e7;
  font-weight: bold;
}
.ocultar {
  display: none;
}

.fa-chevron:before {
  content: "\f054"; /*right*/
}
.in > .fa-chevron:before {
  content: "\f078"; /*down*/
}
.vue-grid-item {
  background: #feff9c;
  opacity: 0.5;
  transition-duration: 100ms;
}
</style>


